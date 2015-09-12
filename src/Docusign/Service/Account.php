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

class Account extends Service {

	public $account;

	/**
	* Constructs the internal representation of the DocuSign Account service.
	*
	* @param DocuSign_Client $client
	*/
	public function __construct(DocuSign_Client $client) {
		parent::__construct($client);
		$this->account = new DocuSign_AccountResource($this);
	}
}

class DocuSign_InitialUser extends DocuSign_Model {
	private $email;
	private $firstName;
	private $lastName;
	private $userName;
	private $password;

	public function __construct($email, $firstName, $lastName, $userName, $password = '') {
		if( isset($email) ) $this->email = $email;
		if( isset($firstName) ) $this->firstName = $firstName;
		if( isset($lastName) ) $this->lastName = $lastName;
		if( isset($userName) ) $this->userName = $userName;
		if( isset($password) ) $this->password = $password;
	}

	public function setEmail($email) { $this->email = $email; }
	public function getEmail() { return $this->email; }
	public function setFirstName($firstName) { $this->firstName = $firstName; }
	public function getFirstName() { return $this->firstName; }
	public function setLastName($lastName) { $this->lastName = $lastName; }
	public function getLastName() { return $this->lastName; }
	public function setUserName($userName) { $this->userName = $userName; }
	public function getUserName() { return $this->userName; }
	public function setPassword($password) { $this->password = $password; }
	public function getPassword() { return $this->password; }
}


class DocuSign_ReferralInformation extends DocuSign_Model {
	private $referralCode;
	private $referrerName;

	public function __construct($referralCode, $referrerName) {
		if( isset($referralCode) ) $this->referralCode = $referralCode;
		if( isset($referrerName) ) $this->referrerName = $referrerName;
	}

	public function setReferralCode($referralCode) { $this->referralCode = $referralCode; }
	public function getReferralCode() { return $this->referralCode; }
	public function setReferrerName($referrerName) { $this->referrerName = $referrerName; }
	public function getReferrerName() { return $this->referrerName; }
}


?>