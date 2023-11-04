<?php

namespace App\Filament\Resources\UndergraduateResource\Pages;

use App\Filament\Resources\UndergraduateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUndergraduates extends ListRecords
{
    protected static string $resource = UndergraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
