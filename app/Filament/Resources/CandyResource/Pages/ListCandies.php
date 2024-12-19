<?php

namespace App\Filament\Resources\CandyResource\Pages;

use App\Filament\Resources\CandyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCandies extends ListRecords
{
    protected static string $resource = CandyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
