<?php

namespace App\Filament\Resources\CandyResource\Pages;

use App\Filament\Resources\CandyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandy extends EditRecord
{
    protected static string $resource = CandyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
