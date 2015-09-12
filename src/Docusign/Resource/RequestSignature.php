<?php

namespace Docusign\Resource;

class RequestSignature extends Resource {

    public function __construct(DocuSign_Service $service) {
        parent::__construct($service);
    }


    public function createEnvelopeFromTemplate( $emailSubject
                                                , $emailBlurb
                                                , $templateId
                                                , $status = "created"
                                                , $templateRoles = array()
                                                , $eventNotifications = array() ) {
        $url = $this->client->getBaseURL() . '/envelopes';
        $data = array (
            "emailSubject" => $emailSubject,
            "emailBlurb" => $emailBlurb,
            "templateId" => $templateId,
            "status" => $status
        );
        if( isset($templateRoles) && sizeof($templateRoles) > 0 ) {
            $templateRolesList = array();
            foreach( $templateRoles as $templateRole ) {
                array_push($templateRolesList, array (
                    "roleName" => $templateRole->getRolename(),
                    "name" => $templateRole->getName(),
                    "email" => $templateRole->getEmail()
                ));
            }
            $data['templateRoles'] = $templateRolesList;
        }
        if( isset($eventNotifications) && sizeof($eventNotifications) > 0 ){
            $data['eventNotification'] = $eventNotifications->toArray();
        }
        return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
    }


    public function createEnvelopeFromDocument( $emailSubject
                                                , $emailBlurb
                                                , $status = "created"
                                                , $documents = array()
                                                , $recipients = array()
                                                , $eventNotifications = array()
                        , $options = array() ) {
        $url = $this->client->getBaseURL() . '/envelopes';
        $headers = $this->client->getHeaders('Accept: application/json', 'Content-Type: multipart/form-data;boundary=myboundary');
        $doc = array();
        $contentDisposition = '';
        foreach( $documents as $document ) {
            array_push($doc, array(
                "name" => $document->getName(),
                "documentId" => $document->getId()
            ));

            $contentDisposition .= "--myboundary\r\n"
                                ."Content-Type:application/pdf\r\n"
                                ."Content-Disposition: file; filename=\""
                                .$document->getName()
                                ."\"; documentid="
                                .$document->getId()
                                ."\r\n"
                                ."\r\n"
                                .$document->getContent()
                                ."\r\n";
        }
        $data = array (
          "emailSubject" => $emailSubject,
          "emailBlurb" => $emailBlurb,
          "documents" => $doc,
          "status" => $status
        );
    if(!empty($options)) {
      $data = array_merge($data, $options);
    }
        if( isset($recipients) && sizeof($recipients) > 0 ) {
            $recipientsList = array();
            foreach( $recipients as $recipient ) {
                $recipientsList[$recipient->getType()][] = array (
                    "routingOrder" => $recipient->getRoutingOrder(),
                    "recipientId" => $recipient->getId(),
                    "name" => $recipient->getName(),
                    "email" => $recipient->getEmail(),
                    "clientUserId" => $recipient->getClientId(),
                    "tabs" => $recipient->getTabs(),
                );
            }
            $data['recipients'] = $recipientsList;
        }
        if( isset($eventNotifications) && sizeof($eventNotifications) > 0 ){
            $data['eventNotification'] = $eventNotifications->toArray();
        }
        $data_string = json_encode($data);
        $data = "\r\n"
                ."\r\n"
                ."--myboundary\r\n"
                ."Content-Type: application/json\r\n"
                ."Content-Disposition: form-data\r\n"
                ."\r\n"
                . $data_string
                ."\r\n"
                . $contentDisposition
                ."--myboundary--";
        return $this->curl->makeRequest($url, 'POST',  $headers, array(), $data);
    }

}
