<?php namespace Mitch\Hashids;

use Illuminate\Support\Facades\Facade;

class Hashids extends Facade {

    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor() { return 'Hashids\Hashids'; }

}