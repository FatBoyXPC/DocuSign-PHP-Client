<?php

namespace Docusign\Resource;

use Docusign\Service\Service;

class Account extends Resource {

    public function __construct(Service $service) {
        parent::__construct($service);
    }


    public function getAccountProvisioning($appToken) {
        $url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/v2/accounts/provisioning';
        $headers = $this->client->getHeaders();
        array_push($headers, 'X-DocuSign-AppToken:' . $appToken);
        return $this->curl->makeRequest($url, 'GET', $headers);
    }


    public function getInfo() {
        $url = $this->client->getBaseURL();
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getBillingPlan() {
        $url = $this->client->getBaseURL() . '/billing_plan';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getBillingChargeList() {
        $url = $this->client->getBaseURL() . '/billing_charges';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getBillingInvoiceList() {
        $url = $this->client->getBaseURL() . '/billing_invoices';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getSettingList() {
        $url = $this->client->getBaseURL() . '/settings';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getBrandList() {
        $url = $this->client->getBaseURL() . '/brands';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function getCustomFieldList() {
        $url = $this->client->getBaseURL() . '/custom_fields';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }


    public function createAccount(  $accountName,
                                    $distributorCode,
                                    $distributorPassword,
                                    $planId,
                                    $initialUser,
                                    $referralInformation ) {
        $url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/v2/accounts';
        $data = array(
            "accountName" => $accountName,
            "distributorCode" => $distributorCode,
            "distributorPassword" => $distributorPassword,
            "planInformation" => array("planId" => $planId),
            "initialUser" => array( 
                "email" => $initialUser->getEmail(),
                "firstName" => $initialUser->getFirstName(),
                "lastName" => $initialUser->getLastName(),
                "userName" => $initialUser->getUserName(),
                "password" => $initialUser->getPassword(),
            ),
            "referralInformation" => array(
                "referralCode" => $referralInformation->getReferralCode(),
                "referrerName" => $referralInformation->getReferrerName(),
            ),
        );
        return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
    }

}