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
    public function listtags()
    {
        $this->curl->get('accounts/listtags');
    }

    /**
     * Retrieves the shippinr carrier account details for the specified carried code.
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
        $cust_params = '';

        if(!empty($params)) {
            foreach($params as $param => $value) {
                if($param == 'stateCode') {
                    $cust_params .= "stateCode={$value}";
                }
                if($param == 'countryCode') {
                    $cust_params .= "countryCode={$value}";
                }
                if($param == 'tagId') {
                    $cust_params .= "tagId={$value}";
                }
                if($param == 'marketplaceId') {
                    $cust_params .= "marketplaceId={$value}";
                }
                if($param == 'sortBy') {
                    $cust_params .= "sortBy={$value}";
                }
                if($param == 'sortDir') {
                    $cust_params .= "sortDir={$value}";
                }
                if($param == 'page') {
                    $cust_params .= "page={$value}";
                }
                if($param == 'pageSize') {
                    $cust_params .= "pageSize={$value}";
                }
            }
        }

        if($cust_params != '') {
            $this->curl->get("customers?{$cust_params}");
        }

        $this->curl->get('customers');
    }

}