<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MediaUploader
{
    public function uploadAsWebP(Model $model, UploadedFile $file, string $collection): void
    {
        $webpContent = $this->convertToWebP($file);
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'.webp';

        /** @phpstan-ignore-next-line */
        $model->addMediaFromString($webpContent)
            ->usingFileName($fileName)
            ->toMediaCollection($collection);
    }

    private function convertToWebP(UploadedFile $file, int $quality = 100): string
    {
        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decode($file->getRealPath());

        return (string) $image->encodeUsingFileExtension('webp', quality: $quality);
    }
}
