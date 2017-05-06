<?php

namespace Abdualrhmanio\MobilyWsSms;


use Illuminate\Support\Facades\Facade;

class MobilyWsSmsFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'mobilywssms';
    }

}
