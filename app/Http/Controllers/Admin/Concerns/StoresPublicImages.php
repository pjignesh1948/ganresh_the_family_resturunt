<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StoresPublicImages
{
    protected function storePublicImage(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, 'public');
    }

    protected function deletePublicImage(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
