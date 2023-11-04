<?php

namespace App\Filament\Resources\UndergraduateResource\Pages;

use App\Filament\Resources\UndergraduateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUndergraduate extends EditRecord
{
    protected static string $resource = UndergraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
