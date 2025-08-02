<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class TrixAttachmentService
{
    /**
     * Store a Trix attachment uploaded file
     */
    public function store(UploadedFile $file): string
    {
        $path = $file->storePublicly('attachments', 'public');
        return Storage::disk('public')->url($path);
    }

    /**
     * Delete Trix attachments
     *
     * @param Collection $attachments
     */
    public function delete(Collection $attachments): void
    {
        foreach ($attachments as $attachment) {
            $split = explode('/', $attachment->attachable->url);
            $path = 'attachments/' . end($split);
            Storage::disk('public')->delete($path);
        }
    }
}
