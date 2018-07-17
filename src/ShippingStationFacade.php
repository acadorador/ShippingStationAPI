<?php

namespace ShippingStation;

use Illuminate\Support\Facades\Facade;

class ShippingStationFacade extends Facade 
{
    
    protected static function getFacadeAccessor() {

        return 'shippingstation';

    }
}