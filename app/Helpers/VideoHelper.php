<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Extract YouTube video ID from URL
     * Supports: https://youtube.com/watch?v=ID, https://youtu.be/ID, etc
     */
    public static function getYoutubeEmbedUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        $videoId = null;

        // Pattern for youtube.com/watch?v=ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Pattern for youtu.be/ID
        elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // Pattern for youtube.com/embed/ID
        elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }
        // If URL is already just the video ID
        elseif (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            $videoId = $url;
        }

        if ($videoId) {
            return "https://www.youtube.com/embed/{$videoId}?rel=0";
        }

        return null;
    }
}
