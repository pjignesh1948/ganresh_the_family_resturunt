<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $fillable = [
        'video_category_id',
        'title',
        'description',
        'youtube_url',
        'video_file',
        'thumbnail',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function videoCategory(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public function youtubeVideoId(): ?string
    {
        if (empty($this->youtube_url)) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->youtube_url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function youtubeEmbedUrl(): ?string
    {
        $videoId = $this->youtubeVideoId();

        return $videoId ? "https://www.youtube.com/embed/{$videoId}" : null;
    }

    public function youtubeEmbedHtml(int $width = 560, int $height = 315): ?string
    {
        $embedUrl = $this->youtubeEmbedUrl();

        if (! $embedUrl) {
            return null;
        }

        return sprintf(
            '<iframe width="%d" height="%d" src="%s" title="%s" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
            $width,
            $height,
            e($embedUrl),
            e($this->title)
        );
    }
}
