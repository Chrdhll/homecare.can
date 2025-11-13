<?php

namespace App\Filament\Admin\Resources\ServiceAreaResource\Pages;

use App\Filament\Admin\Resources\ServiceAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceAreas extends ListRecords
{
    protected static string $resource = ServiceAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
