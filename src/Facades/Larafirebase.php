<?php

namespace Kutia\Larafirebase\Facades;

use Illuminate\Support\Facades\Facade;

class Larafirebase extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'larafirebase';
    }
}
