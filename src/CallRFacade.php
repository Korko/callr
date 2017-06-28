<?php

namespace Korko\CallR;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for CallR Package
 *
 * @author Jeremy Lemesle <jeremy.lemesle@korko.fr>
 */
class CallRFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'callr';
    }
}
