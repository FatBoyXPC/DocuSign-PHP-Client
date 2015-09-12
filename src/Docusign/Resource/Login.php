<?php

namespace Docusign\Resource;

class Login extends Resource {

    public function __construct(DocuSign_Service $service) {
        parent::__construct($service);
        $this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/login_information';
    }


    public function getLoginInformation() {
        return $this->curl->makeRequest($this->url, 'GET', $this->client->getHeaders());
    }


    public function getToken() {
        $this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/token';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );
        $data = array (
            'grant_type' => 'password',
            'scope' => 'api',
            'client_id' => $this->client->getCreds()->getIntegratorKey(),
            'username' => $this->client->getCreds()->getEmail(),
            'password' => $this->client->getCreds()->getPassword()
        );
        return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
    }


    public function getTokenOnBehalfOf($userName, $bearer) {
        $this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/token';
        $headers = array(
            'Authorization: bearer ' . $bearer,
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );
        $data = array(
            'grant_type' => 'password',
            'scope' => 'api',
            'client_id' => $this->client->getCreds()->getIntegratorKey(),
            'username' => $userName,
            'password' => 'password'
        );
        return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
    }


    public function revokeToken($token) {
        $this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/oauth2/revoke';
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );
        $data = array(
            'token' => $token
        );
        return $this->curl->makeRequest($this->url, 'POST', $headers, array(), http_build_query($data));
    }


    public function updatePassword($newPassword) {
        $this->url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/' . $this->client->getVersion() . '/login_information/password';
        $data = array(
            "currentPassword" => $this->client->getCreds()->getPassword(),
            "email" => $this->client->getCreds()->getEmail(),
            "newPassword" => $newPassword
        );
        return $this->curl->makeRequest($this->url, 'PUT', $this->client->getHeaders(), array(), json_encode($data));   
    }

}
