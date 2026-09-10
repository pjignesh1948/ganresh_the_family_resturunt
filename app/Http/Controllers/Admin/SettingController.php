<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresPublicImages;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    use StoresPublicImages;

    private const KEYS = [
        'site_name',
        'tagline',
        'phone',
        'email',
        'address',
        'opening_hours',
        'facebook_url',
        'instagram_url',
        'whatsapp_number',
        'google_maps_embed',
        'order_notify_email',
        'logo',
        'favicon',
    ];

    public function edit(): View
    {
        $settings = SiteSetting::query()
            ->whereIn('key', self::KEYS)
            ->pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'site_name' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:500'],
            'instagram_url' => ['nullable', 'url', 'max:500'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'google_maps_embed' => ['nullable', 'string'],
            'order_notify_email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:512'],
        ];

        $validated = $request->validate($rules);

        foreach (self::KEYS as $key) {
            if (in_array($key, ['logo', 'favicon'], true)) {
                if ($request->hasFile($key)) {
                    $oldPath = SiteSetting::get($key);
                    $this->deletePublicImage($oldPath);
                    SiteSetting::set($key, $this->storePublicImage($request->file($key), 'settings'));
                }

                continue;
            }

            if (array_key_exists($key, $validated)) {
                SiteSetting::set($key, $validated[$key]);
            }
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Site settings updated successfully.');
    }
}
