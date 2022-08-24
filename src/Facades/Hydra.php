<?php

namespace Immera\Hydra\Facades;

use Illuminate\Support\Facades\Facade;

class Hydra extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hydra';
    }
}
