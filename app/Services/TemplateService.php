<?php

namespace App\Services;

class TemplateService
{
    public static function all(): array
    {
        return [
            'gampil' => [
                'id' => 'gampil',
                'name' => 'Custom Template (Kustomisasi Bebas)',
                'category' => 'Custom / Universal',
                'badge' => 'Customizable',
                'description' => 'Landing page serbaguna dengan hero section modern, foto/thumbnail, artikel dinamis, dan iframe opsional.',
                'title' => 'Portal Berita & Informasi Resmi - Gampil Akses',
                'preview_description' => 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.',
                'heading' => 'Portal Informasi & Publikasi Resmi',
                'og_image' => 'images/landing/default-thumbnail.jpg',
                'decoy_iframe_url' => '',
                'icon' => 'fa-sliders',
                'color' => 'from-slate-700 to-indigo-900',
            ],
            'bansos' => [
                'id' => 'bansos',
                'name' => 'Portal Cek Bansos & Perubahan Desil',
                'category' => 'Pelayanan Publik / DTKS',
                'badge' => 'Bansos & Desil',
                'description' => 'Portal terpadu pengecekan status bantuan sosial (PKH, BPNT, PBI-JK) dan pemutakhiran data desil ekonomi DTKS.',
                'title' => 'Jadwal Pencairan & Cek NIK KTP Penerima Bansos PKH 2026 - Gampil Akses',
                'preview_description' => 'Cek jadwal pencairan dan status NIK KTP penerima Bantuan Sosial PKH, BPNT, dan perubahan desil DTKS terbaru.',
                'heading' => 'Jadwal Pencairan & Cek NIK Bansos PKH',
                'og_image' => 'images/landing/bansos-jadwal.jpg',
                'decoy_iframe_url' => '',
                'icon' => 'fa-id-card',
                'color' => 'from-blue-600 to-indigo-800',
            ],
            'klaim-dana' => [
                'id' => 'klaim-dana',
                'name' => 'Panduan Klaim Saldo Digital',
                'category' => 'Tutorial & Voucher',
                'badge' => 'Tutorial',
                'description' => 'Step-by-step digital voucher claiming guide with interactive buttons.',
                'title' => 'Panduan Resmi Klaim Saldo & Voucher Digital Gratis',
                'preview_description' => 'Ikuti langkah mudah untuk klaim saldo digital dan voucher resmi tanpa dipungut biaya.',
                'heading' => 'Panduan Klaim Saldo Digital',
                'og_image' => 'images/landing/template-saldo.jpg',
                'decoy_iframe_url' => '',
                'icon' => 'fa-circle-check',
                'color' => 'from-cyan-500 to-blue-600',
            ],
            'diamond' => [
                'id' => 'diamond',
                'name' => 'Free Fire / MLBB Kode Redeem & Top Up',
                'category' => 'Gaming / Esports',
                'badge' => 'Top Up & Redeem',
                'description' => 'Esports ID news article claiming Free Fire diamond redeem codes & free skin rewards.',
                'title' => 'Kode Redeem Free Fire & Top Up Diamond Gratis 2026 | Esports ID',
                'preview_description' => 'Dapatkan deretan kode redeem Free Fire (FF) terbaru hari ini. Klaim ribuan diamond dan skin langka gratis!',
                'heading' => 'KODE REDEEM FREE FIRE',
                'og_image' => 'images/landing/bg.jpg',
                'decoy_iframe_url' => 'https://reward.ff.garena.com/id',
                'icon' => 'fa-gem',
                'color' => 'from-amber-500 to-red-500',
            ],
            'penarikandana' => [
                'id' => 'penarikandana',
                'name' => 'Konfirmasi Penarikan Dana',
                'category' => 'Finance & E-Wallet',
                'badge' => 'Finance',
                'description' => 'Official-looking balance withdrawal confirmation page with verification triggers.',
                'title' => 'Konfirmasi Penarikan Saldo Dompet Digital - DANA Indonesia',
                'preview_description' => 'Periksa dan konfirmasi detail penarikan saldo e-wallet Anda sebelum pencairan ke rekening tujuan.',
                'heading' => 'Konfirmasi Penarikan Saldo',
                'og_image' => 'images/landing/dana-logo.jpg',
                'decoy_iframe_url' => 'https://www.dana.id/',
                'icon' => 'fa-wallet',
                'color' => 'from-emerald-500 to-teal-600',
            ],
            'chatme' => [
                'id' => 'chatme',
                'name' => 'Chat Me — Let\'s Talk',
                'category' => 'Dating & Chat',
                'badge' => 'Social',
                'description' => 'Modern playful chat invite page with instant chat action buttons.',
                'title' => 'Chat Me — Pesan Masuk Baru',
                'preview_description' => 'Seseorang telah mengirimkan pesan pribadi untuk Anda. Buka dan balas obrolan sekarang.',
                'heading' => 'Chat Baru Menunggu Anda',
                'og_image' => 'images/landing/kapan-pulang.jpg',
                'decoy_iframe_url' => 'https://web.whatsapp.com/',
                'icon' => 'fa-comments',
                'color' => 'from-purple-500 to-pink-500',
            ],
            'instagram' => [
                'id' => 'instagram',
                'name' => 'Instagram Private Profile',
                'category' => 'Social Media',
                'badge' => 'Instagram',
                'description' => 'Instagram dark-mode private profile with follower stats and follow request trigger.',
                'title' => 'sell122 • Instagram photos and videos',
                'preview_description' => '49 Followers, 196 Following, 0 Posts - See Instagram photos and videos from sell122',
                'heading' => 'sell122',
                'og_image' => 'images/landing/instagram-thumbnail.jpg',
                'decoy_iframe_url' => 'https://www.instagram.com/',
                'icon' => 'fa-brands fa-instagram',
                'color' => 'from-pink-600 via-purple-600 to-amber-500',
            ],
        ];
    }

    public static function get(string $key): ?array
    {
        $aliases = [
            'kapan-pulang' => 'gampil',
            'chat' => 'bansos',
            'template' => 'klaim-dana',
        ];

        $normalizedKey = $aliases[$key] ?? $key;
        return static::all()[$normalizedKey] ?? null;
    }
}
