<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StoresPublicImages
{
    /**
     * Store uploaded image in public/uploads (works on GoDaddy without storage symlink).
     */
    protected function storePublicImage(UploadedFile $file, string $folder): string
    {
        $folder = trim(str_replace(['..', '\\'], '', $folder), '/');
        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::uuid()->toString().'.'.$extension;
        $relativePath = 'uploads/'.$folder.'/'.$filename;
        $targetDir = public_path('uploads/'.$folder);

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $filename);

        return $relativePath;
    }

    protected function deletePublicImage(?string $path): void
    {
        if (! $path || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return;
        }

        if (str_starts_with($path, 'uploads/')) {
            $fullPath = public_path($path);
            if (is_file($fullPath)) {
                @unlink($fullPath);
            }

            return;
        }

        Storage::disk('public')->delete($path);
    }
}
