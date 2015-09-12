<?php

namespace Docusign\Resource;

class Envelope extends Resource {

    public function __construct(DocuSign_Service $service) {
        parent::__construct($service);
    }
    
    public function getEnvelope($envelopeId) {
        if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
        {
            return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
        }
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId;
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }

    public function getEnvelopeRecipients($envelopeId) {
        if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
        {
            return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
        }
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/recipients';
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }

    public function getEnvelopeDocuments($envelopeId, $documentId = NULL) {
        if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
        {
            return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
        }
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/documents/';
        if(isset($documentId)) $url .= $documentId;
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
    }

    public function getEnvelopeDocumentsCombined($envelopeId, $certificate = true) {
        if (!preg_match("/^[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/i",$envelopeId))
        {
            return "Bad Request:  Invalid Envelope Id \"$envelopeId\".\nEnvelope Id should be a 32 digit GUID in following format:  1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f\n";
        }
        $url = $this->client->getBaseURL() . '/envelopes/' . $envelopeId . '/documents/combined';
        $params = (is_bool($certificate) === true) ? array( 'certificate' => 'true') : array();
        return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders('Accept: application/pdf', 'Content-Type: application/pdf'), $params);
    }

}
