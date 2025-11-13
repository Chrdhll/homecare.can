<?php

namespace App\Filament\Admin\Resources\ServiceAreaResource\Pages;

use App\Filament\Admin\Resources\ServiceAreaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceArea extends CreateRecord
{
    protected static string $resource = ServiceAreaResource::class;

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
