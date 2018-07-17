<?php

namespace Adorador\ShippingStation\Test;

use Adorador\ShippingStation\ShippingStation;


class ShippingStationTest extends TestCase 
{

    public function testAddition() 
    {
        $result = ShippingStation::add(5,1);

        $this->assertEquals(6, $result);
    }

}