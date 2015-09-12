<?php

namespace Docusign\Resource;

use Docusign\Service\Service;

class Views extends Resource {

    public function __construct(Service $service) {
        parent::__construct($service);
    }


    public function getConsoleView() {
        $url = $this->client->getBaseURL() . '/views/console';
        return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders());
    }


    public function getSenderView($returnUrl, $envelopeId) {
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/views/sender';
        $data = array (
            'returnUrl' => $returnUrl
        );
        return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
    }


    public function getRecipientView($returnUrl, $envelopeId, $userName, $email, $clientUserId = NULL, $authMethod = "email") {
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/views/recipient';
        $data = array (
            'returnUrl' => $returnUrl,
            'authenticationMethod' => $authMethod,
            'userName' => $userName,
            'email' => $email,
            'clientUserId' => $clientUserId,
        );
        return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
    }

}
