<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use App\Filament\Support\MediaUpload;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! empty($data['file_url']) && is_string($data['file_url'])) {
            $resolved = MediaUpload::resolvePublicPath($data['file_url']);
            if ($resolved !== null) {
                $data['file_url'] = $resolved;
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
