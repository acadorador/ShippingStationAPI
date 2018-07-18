<?php

namespace ShippingStation;

class ShippingStation 
{
    /**
     * Shipping Station Curl
     * @var
     */
    private $curl;

    /**
     * Construct
     * @param $config
     */
    public function __construct($config)
    {
        $this->curl = new ShippingStationCurl($config['api_key'],$config['api_token']);
    }

    /**
     * Create a new ShipStation Account
     * @param $data
     */
    public function registerAccount($data)
    {
        $this->curl->post('accounts/registeraccount',$data);
    }

    /**
     * List all tags defined for this account
     */
    public function listTags()
    {
        $this->curl->get('accounts/listtags');
    }

    /**
     * Retrieves the shipping carrier account details for the specified carried code.
     * @param null $carrierCode
     */
    public function listCarriers($carrierCode = null)
    {
        $url = $carrierCode ? 'carriers/getcarrier?carrierCode='.$carrierCode : 'carriers/getcarrier';
        $this->curl->get($url);
    }

    /**
     * Add funds to a carrier account using payment information on the file
     * @param $data
     */
    public function addFunds($data)
    {
        $this->curl->post('carrier/addfunds',$data);
    }


    /**
     * Retrieves a list of packages for the specified carrier
     * @param null $carrierCode
     */
    public function listPackages($carrierCode = null)
    {
        $url = $carrierCode ? 'carriers/listpackages?carrierCode='.$carrierCode : 'carriers/listpackages';
        $this->curl->get($url);
    }

    /**
     * Retrieves a list of available shipping services for the specified carrier
     * @param null $carrierCode
     */
    public function listServices($carrierCode = null)
    {
        $url = $carrierCode ? 'carriers/listservices?carrierCode='.$carrierCode : 'carriers/listservices';
        $this->curl->get($url);
    }

    /**
     * Get a specific customer
     * @param null $customer
     */
    public function customer($customer = null)
    {
        $url = $customer ? "customers/{$customer}" : 'customers';
        $this->curl->get($url);
    }

    /**
     * params: stateCode, countryCode, tagId, marketplaceId, sortBy, sortDir, page, pageSize
     * @param array $params
     */
    public function customers($params = [])
    {
        $new_params = '';

        if(!empty($params)) {
            foreach($params as $param => $value) {
                if($param == 'stateCode') {
                    $new_params .= "stateCode={$value}&";
                }
                if($param == 'countryCode') {
                    $new_params .= "countryCode={$value}&";
                }
                if($param == 'tagId') {
                    $new_params .= "tagId={$value}&";
                }
                if($param == 'marketplaceId') {
                    $new_params .= "marketplaceId={$value}&";
                }
                if($param == 'sortBy') {
                    $new_params .= "sortBy={$value}&";
                }
                if($param == 'sortDir') {
                    $new_params .= "sortDir={$value}&";
                }
                if($param == 'page') {
                    $new_params .= "page={$value}&";
                }
                if($param == 'pageSize') {
                    $new_params .= "pageSize={$value}";
                }
            }
        }

        if($new_params != '') {
            $new_params = rtrim($new_params,'&');
            $this->curl->get("customers?{$new_params}");
        }

        $this->curl->get('customers');
    }

    /**
     * Obtains a list of fulfillments
     * @param array $params
     */
    public function fulfillments($params = [])
    {
        if(empty($params)) {
            $this->curl->get('fulfillments');
        }

        $new_params = '';
        foreach($params as $param => $value) {
            if($param == 'fulfillmentId') {
                $new_params .= "fulfillmentId={$value}&";
            }
            if($param == 'orderId') {
                $new_params .= "orderId={$value}&";
            }
            if($param == 'orderNumber') {
                $new_params .= "orderNumber={$value}&";
            }
            if($param == 'trackingNumber') {
                $new_params .= "trackingNumber={$value}&";
            }
            if($param == 'recipientName') {
                $new_params .= "recipientName={$value}&";
            }
            if($param == 'createDateStart') {
                $new_params .= "createDateStart={$value}&";
            }
            if($param == 'createDateEnd') {
                $new_params .= "createDateEnd={$value}&";
            }
            if($param == 'shipDateStart') {
                $new_params .= "shipDateStart={$value}&";
            }
            if($param == 'shipDateEnd') {
                $new_params .= "shipDateEnd={$value}&";
            }
            if($param == 'sortBy') {
                $new_params .= "sortBy={$value}&";
            }
            if($param == 'sortDir') {
                $new_params .= "sortDir={$value}&";
            }
            if($param == 'page') {
                $new_params .= "page={$value}&";
            }
            if($param == 'pageSize') {
                $new_params .= "pageSize={$value}";
            }
        }
        $new_params = rtrim($new_params,'&');
        $this->curl->get("fulfillments?{$new_params}");
    }

    /**
     * Retrieves a single order
     * @param $id
     */
    public function getOrder($id)
    {
        $this->curl->get("orders/{$id}");
    }

    /**
     * Deletes a single order
     * @param $id
     */
    public function deleteOrder($id)
    {
        $this->curl->delete("orders/{$id}");
    }

    /**
     * Adds a tag to an order
     * @param $data
     */
    public function addTag($data)
    {
        $this->curl->post('orders/addtag',$data);
    }

    /**
     * Assign a user to an order
     * @param $data
     */
    public function orderAssignUser($data)
    {
        $this->curl->post('orders/assignuser',$data);
    }

    /**
     * Creates a shipping label for a given order.
     * @param $data
     */
    public function orderCreateLabel($data)
    {
        $this->curl->post('orders/create/labelfororder',$data);
    }

    /**
     * Create / Update order. If the orderKey is specified in the data
     * the api call becomes an update order.
     * @param $data
     */
    public function orderUpdateCreate($data)
    {
        $this->curl->post('orders/createorder',$data);
    }

    /**
     * Create / Update order. If the orderKey is specified in the data
     * the api call becomes an update order however this is for
     * multiple order data.
     * @param $data
     */
    public function multipleOrderUpdateCreate($data)
    {
        $this->curl->post('orders/createorder',$data);
    }

    /**
     * This will change the status of the given order to on hold.
     * @param $data
     */
    public function orderHoldUntil($data)
    {
        $this->curl->post('orders/holduntil',$data);
    }

    /**
     * Obtains a list of orders
     * @param array $params
     */
    public function orders($params = [])
    {
        if(empty($params))
        {
            $this->curl->get('orders');
        }

        $new_params = '';
        foreach($params as $param => $value) {
            if($param == 'customerName') {
                $new_params .= "customerName={$value}&";
            }
            if($param == 'itemKeyword') {
                $new_params .= "itemKeyword={$value}&";
            }
            if($param == 'modifyDateStart') {
                $new_params .= "modifyDateStart={$value}&";
            }
            if($param == 'modifyDateEnd') {
                $new_params .= "modifyDateEnd={$value}&";
            }
            if($param == 'createDateStart') {
                $new_params .= "createDateStart={$value}&";
            }
            if($param == 'createDateEnd') {
                $new_params .= "createDateEnd={$value}&";
            }
            if($param == 'orderDateStart') {
                $new_params .= "orderDateStart={$value}&";
            }
            if($param == 'orderDateEnd') {
                $new_params .= "orderDateEnd={$value}&";
            }
            if($param == 'orderNumber') {
                $new_params .= "orderNumber={$value}&";
            }
            if($param == 'orderStatus') {
                $new_params .= "orderStatus={$value}&";
            }
            if($param == 'paymentDateStart') {
                $new_params .= "paymentDateStart={$value}&";
            }
            if($param == 'paymentDateEnd') {
                $new_params .= "paymentDateEnd={$value}&";
            }
            if($param == 'storeId') {
                $new_params .= "storeId={$value}&";
            }
            if($param == 'sortBy') {
                $new_params .= "sortBy={$value}&";
            }
            if($param == 'sortDir') {
                $new_params .= "sortDir={$value}&";
            }
            if($param == 'page') {
                $new_params .= "page={$value}&";
            }
            if($param == 'pageSize') {
                $new_params .= "pageSize={$value}&";
            }
        }
        $new_params = rtrim($new_params,'&');
        $this->curl->get("orders?{$new_params}");
    }

    /**
     * List all orders that match the specified status and tag ID.
     * @param array $params
     */
    public function orderListByTags($params = [])
    {
        $new_params = '';

        foreach($params as $param => $value) {
            if($param == 'orderStatus') {
                $new_params .= "orderStatus={$value}&";
            }
            if($param == 'tagId') {
                $new_params .= "tagId={$value}&";
            }
            if($param == 'page') {
                $new_params .= "page={$value}&";
            }
            if($param == 'pageSize') {
                $new_params .= "pageSize={$value}&";
            }
        }
        $new_params = rtrim($new_params,'&');
        $this->curl->get("orders/listbytag?{$new_params}");
    }

    /**
     * Mark order as shipped.
     * @param $data
     */
    public function orderMarkAsShipped($data)
    {
        $this->curl->post('orders/markasshipped',$data);
    }

    /**
     * Removes a tag from the specified order.
     * @param $data
     */
    public function orderRemoveTag($data)
    {
        $this->curl->post('orders/removetag',$data);
    }

    /**
     * Change the status of the order from On Hold to Awaiting Shipment.
     * @param $data
     */
    public function orderRestoreFromHold($data)
    {
        $this->curl->post('orders/restorefromhold',$data);
    }

    /**
     * Unassigns a user from an order
     * @param $data
     */
    public function orderUnassignUser($data)
    {
        $this->curl->post('orders/unassignuser',$data);
    }

    /**
     * Get product by ID
     * @param $id
     */
    public function product($id)
    {
        $this->curl->get("products/{$id}");
    }

    /**
     * Update an existing product
     * @param $id
     * @param $data
     */
    public function productUpdate($id, $data)
    {
        $this->curl->put("products/{$id}",$data);
    }

    /**
     * List of products that match a specified criteria
     * @param array $params
     */
    public function products($params = [])
    {
        if(empty($params)) {
            $this->curl->get('products');
        }

        $new_params = '';
        foreach($params as $param => $value) {
            if($param == 'customerName') {
                $new_params .= "customerName={$value}&";
            }
            if($param == 'itemKeyword') {
                $new_params .= "itemKeyword={$value}&";
            }
            if($param == 'modifyDateStart') {
                $new_params .= "modifyDateStart={$value}&";
            }
            if($param == 'modifyDateEnd') {
                $new_params .= "modifyDateEnd={$value}&";
            }
            if($param == 'createDateStart') {
                $new_params .= "createDateStart={$value}&";
            }
            if($param == 'createDateEnd') {
                $new_params .= "createDateEnd={$value}&";
            }
            if($param == 'orderDateStart') {
                $new_params .= "orderDateStart={$value}&";
            }
            if($param == 'orderDateEnd') {
                $new_params .= "orderDateEnd={$value}&";
            }
            if($param == 'orderNumber') {
                $new_params .= "orderNumber={$value}&";
            }
            if($param == 'orderStatus') {
                $new_params .= "orderStatus={$value}&";
            }
            if($param == 'paymentDateStart') {
                $new_params .= "paymentDateStart={$value}&";
            }
            if($param == 'paymentDateEnd') {
                $new_params .= "paymentDateEnd={$value}&";
            }
            if($param == 'storeId') {
                $new_params .= "storeId={$value}&";
            }
            if($param == 'sortBy') {
                $new_params .= "sortBy={$value}&";
            }
            if($param == 'sortDir') {
                $new_params .= "sortDir={$value}&";
            }
            if($param == 'page') {
                $new_params .= "page={$value}&";
            }
            if($param == 'pageSize') {
                $new_params .= "pageSize={$value}&";
            }
        }
        $new_params = rtrim($new_params,'&');
        $this->curl->get("products?{$new_params}");
    }

    /**
     * Obtain a list of shipments
     * @param array $params
     */
    public function shipments($params = [])
    {
        if(empty($params)) {
            $this->curl->get('shipments');
        }

        $new_params = '';
        foreach($params as $param => $value) {
            if($param == 'recipientName') {
                $new_params .= "recipientName={$value}&";
            }
            if($param == 'recipientCountryCode') {
                $new_params .= "recipientCountryCode={$value}&";
            }
            if($param == 'orderNumber') {
                $new_params .= "orderNumber={$value}&";
            }
            if($param == 'orderId') {
                $new_params .= "orderId={$value}&";
            }
            if($param == 'carrierCode') {
                $new_params .= "carrierCode={$value}&";
            }
            if($param == 'serviceCode') {
                $new_params .= "serviceCode={$value}&";
            }
            if($param == 'trackingNumber') {
                $new_params .= "trackingNumber={$value}&";
            }
            if($param == 'createDateEnd') {
                $new_params .= "createDateEnd={$value}&";
            }
            if($param == 'createDateStart') {
                $new_params .= "createDateStart={$value}&";
            }
            if($param == 'shipDateStart') {
                $new_params .= "shipDateStart={$value}&";
            }
            if($param == 'shipEndStart') {
                $new_params .= "shipEndStart={$value}&";
            }
            if($param == 'voidDateStart') {
                $new_params .= "voidDateStart={$value}&";
            }
            if($param == 'voidDateEnd') {
                $new_params .= "voidDateEnd={$value}&";
            }
            if($param == 'includeShipmentItems') {
                $new_params .= "includeShipmentItems={$value}&";
            }
            if($param == 'sortBy') {
                $new_params .= "sortBy={$value}&";
            }
            if($param == 'sortDir') {
                $new_params .= "sortDir={$value}&";
            }
            if($param == 'page') {
                $new_params .= "page={$value}&";
            }
            if($param == 'pageSize') {
                $new_params .= "pageSize={$value}&";
            }
        }
        $new_params = rtrim($new_params,'&');
        $this->curl->get("shipments?{$new_params}");
    }

    /**
     * Get shipment rates
     * @param $data
     */
    public function shipmentRates($data)
    {
        $this->curl->post('shipments/getrates',$data);
    }

    /**
     * Voids the specified label by shipmentId
     * @param $data
     */
    public function voidLabel($data)
    {
        $this->curl->post('shipments/voidlabel',$data);
    }

    /**
     * Get Stores
     * @param $id
     */
    public function store($id)
    {
        $this->curl->get("stores/{$id}");
    }

    /**
     * Update a specified store by id
     * @param $id
     * @param $data
     */
    public function storeUpdate($id, $data)
    {
        $this->curl->get("stores/{$id}",$data);
    }

    /**
     * Refresh store by ID
     * @param $id
     */
    public function storeRefresh($params = [])
    {
        $new_params = '';
        foreach($params as $param => $value){
            if($param == 'storeId') {
                $new_params .= "storeId={$value}&";
            }
            if($param == 'refreshDate') {
                $new_params .= "refreshDate={$value}&";
            }
        }

        $this->curl->get("stores/getrefreshstatus?{$new_params}");
    }

    /**
     * Get stores list
     * @param $id
     */
    public function storesList($params = [])
    {
        $new_params = '';
        foreach($params as $param => $value){
            if($param == 'showInactive') {
                $new_params .= "showInactive={$value}&";
            }
            if($param == 'marketplaceId') {
                $new_params .= "marketplaceId={$value}&";
            }
        }

        $this->curl->get("stores?{$new_params}");
    }

    /**
     * List Marketplaces
     */
    public function storesMarketPlaces()
    {
        $this->curl->get('stores/marketplaces');
    }

    /**
     * Deactivates the store
     * @param $data
     */
    public function storeDeactivate($data)
    {
        $this->curl->post('stores/deactivate',$data);
    }

    /**
     * Activates the store
     * @param $data
     */
    public function storeReactivate($data)
    {
        $this->curl->post('stores/reactivate',$data);
    }

    /**
     * Show list of users
     * @param $type
     */
    public function users($type)
    {
       if($type) {
           $this->curl->get("users?showInactive={$type}");
       }

       $this->curl->get('users');
    }

    /**
     * Returns a list of warehouse
     * @param $id
     */
    public function warehouse($id)
    {
        $this->curl->get("warehouses/{$id}");
    }

    /**
     * Updates a warehouse
     * @param $id
     * @param $data
     */
    public function warehouseUpdate($id, $data)
    {
        $this->curl->put("warehouses/{$id}",$data);
    }

    /**
     * Create a warehouse
     * @param $data
     */
    public function warehouseCreate($data)
    {
        $this->curl->post('warehouses/createwarehouse',$data);
    }

    /**
     * list of warehouses
     * @param $id
     */
    public function warehouses()
    {
        $this->curl->get('warehouses');
    }

    /**
     * List of webhooks
     */
    public function webhooks()
    {
        $this->curl->get('webhooks');
    }

    /**
     * Subscribe to a webhook
     * @param $data
     */
    public function webhookSubscribe($data)
    {
        $this->curl->post('webhooks/subscribe',$data);
    }

    /**
     * Unsubscribe to a webhook
     * @param $id
     */
    public function webhookUnsubscribe($id)
    {
        $this->curl->delete("webhooks/{$id}");
    }
}