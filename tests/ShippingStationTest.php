<?php

namespace ShippingStation\Test;

use ShippingStation;

class ShippingStationTest extends TestCase 
{

    public function testOrders()
    {
        $response = ShippingStation::orders();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testListTags()
    {
        $response = ShippingStation::listTags();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testListCarriers()
    {
        $response = ShippingStation::listCarriers();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testListPackages()
    {
        $response = ShippingStation::listPackages();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testListServices()
    {
        $response = ShippingStation::listServices();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testCustomers()
    {
        $response = ShippingStation::customers();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testFulfillments()
    {
        $response = ShippingStation::fulfillments();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    /*public function testGetOrder()
    {
        $response = ShippingStation::getOrder(1);
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }*/

    public function testProducts()
    {
        $response = ShippingStation::products();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testShipments()
    {
        $response = ShippingStation::shipments();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testStoresList()
    {
        $response = ShippingStation::storesList();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testStoresMarketPlaces()
    {
        $response = ShippingStation::storesMarketPlaces();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testUsers()
    {
        $response = ShippingStation::users();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testWarehouses()
    {
        $response = ShippingStation::warehouses();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

    public function testWebhooks()
    {
        $response = ShippingStation::webhooks();
        $response = !empty($response) ? true : false;
        $this->assertTrue($response);
    }

}