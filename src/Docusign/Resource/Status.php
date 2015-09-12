<?php

namespace Docusign\Resource;

class Status extends Resource {

    public function __construct(DocuSign_Service $service) {
        parent::__construct($service);
    }


    public function getStatus($fromDate, $status) {
        $date = date("m", $fromDate) . "/" . date("d", $fromDate) . "/". date("Y", $fromDate) . " " . date("H", $fromDate) . ":" . date("i", $fromDate);
        $url = $this->client->getBaseURL() . '/envelopes';
        $params = array (
            "from_date" => $date,
            "from_to_status" => $status
        );

        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders(), $params);
    }

}
