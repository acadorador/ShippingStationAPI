<?php

namespace Adorador\ShippingStation\Test;

use Adorador\ShippingStation\ShippingStationFacade;
use Adorador\ShippingStation\ShippingStationServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     */
    protected function getPackageProviders($app)
    {
        return [ShippingStationServiceProvider::class];
    }

    /**
     * Load package alias
     */
    protected function getPackageAliases($app)
    {
        return [
            'ShippingStation' => ShippingStationFacade::class
        ];
    }
}