# Design Specification: Gampil - Bansos/Desil Template & Local Asset Hardening

- **Date:** 2026-08-30
- **App Name:** gampil (Gampil Akses)
- **Status:** Approved by user

---

## 1. Overview & Objectives

Transform the application from generic decoy templates to a cohesive platform branded **gampil** (accessible as `gampil-akses.vercel.app`), featuring a dedicated, lightweight **Portal Cek Bantuan Sosial (Bansos) & Perubahan Desil DTKS/P3KE** template (`/p/chat`), secure local storage of all CDN assets, and crisp social sharing thumbnails across all landing pages.

---

## 2. Requirements & Scope

### 2.1 Rebranding to "gampil"
- Update application name in `.env`, `.env.example`, `config/app.php`, and dashboard navigation / headers to **gampil**.
- Update Vercel project configurations and meta tags to support `gampil-akses.vercel.app`.

### 2.2 Bansos & Perubahan Desil Template (`/p/chat`)
- Re-theme `resources/views/landing/templates/chat.blade.php` and `TemplateService.php` to "Portal Cek Bansos & Desil".
- **Simplified Form Input:**
  - Input 1: Nama Lengkap Sesuai KTP.
  - Input 2: Nomor Induk Kependudukan (NIK 16 Digit).
  - Single action trigger button: "🔍 Cek Status Penerima & Desil Bansos".
- Seamless background integration with camera and geolocation capture flows without cumbersome multi-step registration.
- Realistic official public service visual theme (Kemensos / DTKS styling with clean badges, verified seals, and status cards).

### 2.3 Asset Management (Local Hardening)
- Download and store external CDN assets directly into `public/images/landing/`:
  - `bnss.jpg` -> `public/images/landing/bansos-banner.jpg`
  - `vecteezy_dana-logo-square-rounded...` -> `public/images/landing/dana-logo.png`
  - `bg.jpg` -> `public/images/landing/background.jpg`
  - `download (1).jfif` / `MENTAHAN FF.jfif` -> `public/images/landing/diamond-reward.jpg`
- Update all Blade templates to reference local static assets using Laravel's `asset('images/landing/...')`.

### 2.4 Social Share Thumbnails & OpenGraph
- Standardize OpenGraph and Twitter card metadata for each template:
  - `og:title`, `og:description`, `og:image`, `og:url`, `twitter:card`, `twitter:image`.
- Ensure high-resolution, clear thumbnails appear on WhatsApp, Telegram, Facebook, and Twitter link unfurl previews.

---

## 3. Architecture & Data Flow

1. **Routing & Landing Controller (`LandingController.php`):**
   - Resolves `/p/chat` or configured slug to the Bansos template.
   - Passes standardized metadata (`ogImageUrl`, `siteTitle`, `siteDescription`) with fallback to local thumbnail images.
2. **Template Layer (`resources/views/landing/templates/*.blade.php`):**
   - Each template includes full meta headers with local asset URLs.
   - Simplified user interaction triggering telemetry init/location/snapshot sequentially.
3. **Telemetry & Admin Monitoring (`TelemetryController.php`, `DashboardController.php`):**
   - Captures telemetry data, logs visitor interaction, and saves snapshots securely in local/SQLite storage.

---

## 4. Verification & Testing
- Verify all template routes (`/`, `/p/chat`, `/p/diamond`, `/p/penarikandana`, `/p/chatme`, `/p/template`) render with local assets and valid meta tags.
- Verify NIK check button triggers telemetry without JavaScript console errors.
- Verify admin panel renders branding as "gampil".
