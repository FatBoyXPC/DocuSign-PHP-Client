<?php
/*
 * Copyright 2013 DocuSign Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Docusign\Service;

require_once 'DocuSign_Service.php';
require_once 'DocuSign_Resource.php';

class RequestSignature extends Service {

	public $signature;

	/**
	* Constructs the internal representation of the DocuSign Request Signature service.
	*
	* @param DocuSign_Client $client
	*/
	public function __construct(DocuSign_Client $client) {
		parent::__construct($client);
		$this->signature = new DocuSign_RequestSignatureResource($this);
	}
}

class DocuSign_Document extends DocuSign_Model {
	private $name;
	private $id;
	private $content;

	public function __construct($name, $id, $content) {
		if( isset($name) ) $this->name = $name;
		if( isset($id) ) $this->id = $id;
		if( isset($content) ) $this->content = $content;
	}

  	public function setName($name) { $this->name = $name; }
	public function getName() { return $this->name; }
	public function setId($id) { $this->id = $id; }
	public function getId() { return $this->id; }
	public function setContent($content) { $this->content = $content; }
	public function getContent() { return $this->content; }
}


class DocuSign_Recipient extends DocuSign_Model {
	private $routingOrder;
	private $id;
	private $name;
	private $email;
	private $clientId;
	private $type;
	private $tabs;

	public function __construct($routingOrder, $id, $name, $email, $clientId = NULL, $type = 'signers', $tabs = NULL) {
		if( isset($routingOrder) ) $this->routingOrder = $routingOrder;
		if( isset($id) ) $this->id = $id;
		if( isset($name) ) $this->name = $name;
		if( isset($email) ) $this->email = $email;
		if( isset($type) ) $this->type = $type;
		// Ensure that a client id only gets assigned to allowed recipient types.
		if (isset($clientId)) {
			switch ($type) {
				case 'signers':
				case 'agents':
				case 'intermediaries':
				case 'editors':
				case 'certifiedDeliveries':
					$this->clientId = $clientId;
					break;
			}
		}
		if( isset($tabs) && is_array($tabs)) {
			foreach ($tabs as $tabType => $tab) {
				foreach ($tab as $singleTab) {
					$this->setTab($tabType, $singleTab);
				}
			}
		}
	}


	public function setRoutingOrder($routingOrder) { $this->routingOrder = $routingOrder; }
	public function getRoutingOrder() { return $this->routingOrder; }
	public function setId($id) { $this->id = $id; }
	public function getId() { return $this->id; }
	public function setName($name) { $this->name = $name; }
	public function getName() { return $this->name; }
	public function setEmail($email) { $this->email = $email; }
	public function getEmail() { return $this->email; }
	public function setClientId($clientId) { $this->clientId = $clientId; }
	public function getClientId() { return $this->clientId; }
	public function setType($type) { $this->type = $type; }
	public function getType() { return $this->type; }
	public function getTabs() { return $this->tabs; }
	public function getTab($tabType, $tabLabel) {
		foreach ($this->tabs[$tabType] as $tab) {
			if ($tab['tabLabel'] == $tabLabel) {
				return array($tabType => $tab);
			}
		}
	}

	public function setTab($tabType, $tab)
	{
		//.. construct tab array
		switch ($tabType) {
			case 'textTabs':
			case 'approveTabs':
			case 'checkboxTabs':
			case 'companyTabs':
			case 'dateSignedTabs':
			case 'dateTabs':
			case 'declineTabs':
			case 'emailTabs':
			case 'emailAddressTabs':
			case 'envelopeIdTabs':
			case 'firstNameTabs':
			case 'formulaTabs':
			case 'fullNameTabs':
			case 'initialHereTabs':
			case 'lastNameTabs':
			case 'noteTabs':
			case 'listTabs':
			case 'numberTabs':
			case 'radioGroupTabs':
			case 'signHereTabs':
			case 'signerAttachmentTabs':
			case 'ssnTabs':
			case 'textTabs':
			case 'titleTabs':
			case 'zipTabs':
				$this->tabs[$tabType][] = $tab;
				break;
		};
	}

	public function unsetTab($tabType, $tabLabel)
	{
		foreach ($this->tabs[$tabType] as &$tab) {
			if ($tab['tabLabel'] == $tabLabel) {
				unset($tab);
			}
		}
	}
}


class DocuSign_TemplateRole extends DocuSign_Model {
	private $roleName;
	private $name;
	private $email;

	public function __construct($roleName, $name, $email) {
		if( isset($roleName) ) $this->roleName = $roleName;
		if( isset($name) ) $this->name = $name;
		if( isset($email) ) $this->email = $email;
	}

  	public function setRoleName($roleName) { $this->roleName = $roleName; }
	public function getRolename() { return $this->roleName; }
	public function setName($name) { $this->name = $name; }
	public function getName() { return $this->name; }
	public function setEmail($email) { $this->email = $email; }
	public function getEmail() { return $this->email; }
}


class DocuSign_EventNotification extends DocuSign_Model {
	private $url;
	private $loggingEnabled;
	private $requireAcknowledgment;
	private $useSoapInterface;
	private $soapNameSpace;
	private $includeCertificateWithSoap;
	private $signMessageWithX509Cert;
	private $includeDocuments;
	private $includeTimeZone;
	private $includeSenderAccountAsCustomField;
	private $envelopeEvents;
	private $recipientEvents;

	public function __construct( $url
								, $loggingEnabled
								, $requireAcknowledgment
								, $useSoapInterface
								, $soapNameSpace
								, $includeCertificateWithSoap
								, $signMessageWithX509Cert
								, $includeDocuments
								, $includeTimeZone
								, $includeSenderAccountAsCustomField
								, $envelopeEvents
								, $recipientEvents ) {
		if( isset($url) ) $this->url = $url;
		if( isset($loggingEnabled) ) $this->loggingEnabled = $loggingEnabled;
		if( isset($requireAcknowledgment) ) $this->requireAcknowledgment = $requireAcknowledgment;
		if( isset($useSoapInterface) ) $this->useSoapInterface = $useSoapInterface;
		if( isset($soapNameSpace) ) $this->soapNameSpace = $soapNameSpace;
		if( isset($includeCertificateWithSoap) ) $this->includeCertificateWithSoap = $includeCertificateWithSoap;
		if( isset($signMessageWithX509Cert) ) $this->signMessageWithX509Cert = $signMessageWithX509Cert;
		if( isset($includeDocuments) ) $this->includeDocuments = $includeDocuments;
		if( isset($includeTimeZone) ) $this->includeTimeZone = $includeTimeZone;
		if( isset($includeSenderAccountAsCustomField) ) $this->includeSenderAccountAsCustomField = $includeSenderAccountAsCustomField;
		if( isset($envelopeEvents) ) $this->envelopeEvents = $envelopeEvents;
		if( isset($recipientEvents) ) $this->recipientEvents = $recipientEvents;		
	}

  	public function setUrl($url) { $this->url = $url; }
	public function getUrl() { return $this->url; }	
  	public function setLoggingEnabled($loggingEnabled) { $this->loggingEnabled = $loggingEnabled; }
	public function getLoggingEnabled() { return $this->loggingEnabled; }	
  	public function setRequireAcknowledgment($requireAcknowledgment) { $this->requireAcknowledgment = $requireAcknowledgment; }
	public function getRequireAcknowledgment() { return $this->requireAcknowledgment; }	
  	public function setUseSoapInterface($useSoapInterface) { $this->useSoapInterface = $useSoapInterface; }
	public function getUseSoapInterface() { return $this->useSoapInterface; }		
  	public function setSoapNameSpace($soapNameSpace) { $this->soapNameSpace = $soapNameSpace; }
	public function getSoapNameSpace() { return $this->soapNameSpace; }	
  	public function setIncludeCertificateWithSoap($includeCertificateWithSoap) { $this->includeCertificateWithSoap = $includeCertificateWithSoap; }
	public function getIncludeCertificateWithSoap() { return $this->includeCertificateWithSoap; }	
	public function setSignMessageWithX509Cert($signMessageWithX509Cert) { $this->signMessageWithX509Cert = $signMessageWithX509Cert; }
	public function getSignMessageWithX509Cert() { return $this->signMessageWithX509Cert; }	
	public function setIncludeDocuments($includeDocuments) { $this->includeDocuments = $includeDocuments; }
	public function getIncludeDocuments() { return $this->includeDocuments; }	
	public function setIncludeTimeZone($includeTimeZone) { $this->includeTimeZone = $includeTimeZone; }
	public function getIncludeTimeZone() { return $this->includeTimeZone; }
	public function setIncludeSenderAccountAsCustomField($includeSenderAccountAsCustomField) { $this->includeSenderAccountAsCustomField = $includeSenderAccountAsCustomField; }
	public function getIncludeSenderAccountAsCustomField() { return $this->includeSenderAccountAsCustomField; }	
	public function setEnvelopeEvents($envelopeEvents) { $this->envelopeEvents = $envelopeEvents; }
	public function getEnvelopeEvents() { return $this->envelopeEvents; }	
	public function setRecipientEvents($recipientEvents) { $this->recipientEvents = $recipientEvents; }
	public function getRecipientEvents() { return $this->recipientEvents; }

	public function toArray() {
		$result = array();
		if( isset($this->url) ) $result['url'] = $this->url;
		if( isset($this->loggingEnabled) ) $result['loggingEnabled'] = $this->loggingEnabled;
		if( isset($this->requireAcknowledgment) ) $result['requireAcknowledgment'] = $this->requireAcknowledgment;
		if( isset($this->useSoapInterface) ) $result['useSoapInterface'] = $this->useSoapInterface;
		if( isset($this->soapNameSpace) ) $result['soapNameSpace'] = $this->soapNameSpace;
		if( isset($this->includeCertificateWithSoap) ) $result['includeCertificateWithSoap'] = $this->includeCertificateWithSoap;
		if( isset($this->signMessageWithX509Cert) ) $result['signMessageWithX509Cert'] = $this->signMessageWithX509Cert;
		if( isset($this->includeDocuments) ) $result['includeDocuments'] = $this->includeDocuments;
		if( isset($this->includeTimeZone) ) $result['includeTimeZone'] = $this->includeTimeZone;
		if( isset($this->includeSenderAccountAsCustomField) ) $result['includeSenderAccountAsCustomField'] = $this->includeSenderAccountAsCustomField;
		if( isset($this->envelopeEvents) && sizeof($this->envelopeEvents) > 0 ) {
			$temp = array();
			foreach( $this->envelopeEvents as $envelopeEvent ) {
				$item = array();
				$item['envelopeEventStatusCode'] = $envelopeEvent;
				array_push($temp, $item);
			}
			if(count($temp) > 0) $result['envelopeEvents'] = $temp;
		}
		if( isset($this->recipientEvents) && sizeof($this->recipientEvents) > 0 ) {
			$temp = array();
			foreach( $this->recipientEvents as $recipientEvent ) {
				$item = array();
				$item['envelopeEventStatusCode'] = $recipientEvents;
				array_push($temp, $item);
			}
			if(count($temp) > 0) $result['envelopeEvents'] = $temp;
		}
		return $result;
	}
}

