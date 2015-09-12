<?php
/*
 * Copyright 2015 DocuSign Inc.
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

class User extends Service {

  public $user;

  /**
  * Constructs the internal representation of the DocuSign User service.
  *
  * @param DocuSign_Client $client
  */
  public function __construct(DocuSign_Client $client) {
    parent::__construct($client);
    $this->user = new DocuSign_UserResource($this);
  }
}

/**
* This class encapsulates the possible parameters that can be supplied when creating a user 
* membership within an account.
*/
class DocuSign_AddUser extends DocuSign_Model {
  
  // The internal representation of the data is in the form that can be directly used in the 
  // API call to add a user membership.
  private $data = array();

  // FUTURE ENHANCEMENT: if an entry already exists for $name, that entry should be updated instead of adding a new entry
  private function addUserSetting($name, $value) { $this->data["userSettings"][] = array("name" => $name, "value" => $value); }

  public function __construct($data = '') {
    if( isset($data) ) $this->data = $data;
  }

  public function setData($data) { $this->data = $data; }
  public function getData() { return $this->data; }

  public function setActivationAccessCode($value) { $this->data["activationAccessCode"] = $value; }
  public function setEmail($value)                { $this->data["email"] = $value; }      // max 100 chars
  public function setEnableConnectForUser($value) { $this->data["enableConnectForUser"] = $value; } // "true"/"false"
  public function setFirstName($value)            { $this->data["firstName"] = $value; }  // max 50 chars
  public function setForgottenPasswordInfo($question1 = '', $answer1 = '',
                                           $question2 = '', $answer2 = '',
                                           $question3 = '', $answer3 = '',
                                           $question4 = '', $answer4 = '') {
    if ( isset($question1) ) { $this->data["forgottenPasswordInfo"]["forgottenPasswordQuestion1"] = $question1; 
                               $this->data["forgottenPasswordInfo"]["forgottenPasswordAnswer1"]   = $answer1; }
    if ( isset($question2) ) { $this->data["forgottenPasswordInfo"]["forgottenPasswordQuestion2"] = $question2; 
                               $this->data["forgottenPasswordInfo"]["forgottenPasswordAnswer2"]   = $answer2; }
    if ( isset($question3) ) { $this->data["forgottenPasswordInfo"]["forgottenPasswordQuestion3"] = $question3; 
                               $this->data["forgottenPasswordInfo"]["forgottenPasswordAnswer3"]   = $answer3; }
    if ( isset($question4) ) { $this->data["forgottenPasswordInfo"]["forgottenPasswordQuestion4"] = $question4; 
                               $this->data["forgottenPasswordInfo"]["forgottenPasswordAnswer4"]   = $answer4; }
  }     
  public function addGroup($value)                { $this->data["groupList"][]["groupId"] = $value; }
  public function setLastName($value)             { $this->data["lastName"] = $value; }    // max 50 chars
  public function setMiddleName($value)           { $this->data["middleName"] = $value; }  // max 50 chars
  public function setPassword($value)             { $this->data["password"] = $value; }    // max 50 chars
  public function setSendActivationOnInvalidLogin($value) { $this->data["sendActivationOnInvalidLogin"] = $value; } // "true"/"false"
  public function setSuffixName($value)           { $this->data["suffixName"] = $value; }  // max 100 chars
  public function setTitle($value)                { $this->data["title"] = $value; }       // max 10 chars
  public function setUserName($value)             { $this->data["userName"] = $value; }    // max 100 chars
  
  public function setAllowRecipientLanguageSelection($bool_value) { $this->addUserSetting("AllowRecipientLanguageSelection", $bool_value); }
  public function setAllowSendOnBehalfOf($bool_value)  { $this->addUserSetting("allowSendOnBehalfOf", $bool_value); }
  public function setApiAccountWideAccess($bool_value) { $this->addUserSetting("apiAccountWideAccess", $bool_value); }
  public function setCanEditSharedAddressBook($value)  { $this->addUserSetting("canEditSharedAddressBook", $value); }
  public function setCanManageAccount($bool_value)     { $this->addUserSetting("canManageAccount", $bool_value); }
  public function setCanManageTemplates($value)        { $this->addUserSetting("canManageTemplates", $value); }
  public function setCanSendAPIRequests($bool_value)   { $this->addUserSetting("canSendAPIRequests", $bool_value); }
  public function setCanSendEnvelope($bool_value)      { $this->addUserSetting("canSendEnvelope", $bool_value); }
  public function setEnableSequentialSigningAPI($bool_value) { $this->daddUserSetting("enableSequentialSigningAPI", $bool_value); }
  public function setEnableSequentialSigningUI($bool_value) { $this->addUserSetting("enableSequentialSigningUI", $bool_value); }
  public function setEnableSignerAttachments($bool_value) { $this->addUserSetting("enableSignerAttachments", $bool_value); }
  public function setEnableSignOnPaperOverride($bool_value) { $this->addUserSetting("enableSignOnPaperOverride", $bool_value); }
  public function setEnableTransactionPoint($bool_value)  { $this->addUserSetting("enableTransactionPoint", $bool_value); }
  public function seEnableVaulting($bool_value)        { $this->addUserSetting("enableVaulting", $bool_value); }  
  public function setLocale($value)                    { $this->addUserSetting("locale", $value); }
  public function setPowerFormAdmin($bool_value)       { $this->addUserSetting("powerFormAdmin", $bool_value); }  
  public function setPowerFormUser($bool_value)        { $this->addUserSetting("powerFormUser", $bool_value); }
  public function setSelfSignedRecipientEmailDocument($value) { $this->addUserSetting("selfSignedRecipientEmailDocument", $value); }
  public function setVaultingMode($value)              { $this->addUserSetting("vaultingMode", $value); }
}

/**
* This class encapsulates the possible parameters that can be supplied when modifying a 
* user profile.
*/
class DocuSign_UserProfile extends DocuSign_Model {
  
  // The internal representation of the data is in the form that can be directly used in the 
  // API call to modify a user profile.
  private $data = array();

  public function __construct($data = '') {
    if( isset($data) ) $this->data = $data;
  }

  public function setData($data) { $this->data = $data; }
  public function getData() { return $this->data; }
  
  public function setAddress1($value)        { $this->data["address"]["address1"] = $value; }
  public function setAddress2($value)        { $this->data["address"]["address2"] = $value; }
  public function setCity($value)            { $this->data["address"]["city"] = $value; }
  public function setCountry($value)         { $this->data["address"]["country"] = $value; }
  public function setFax($value)             { $this->data["address"]["fax"] = $value; }
  public function setPhone($value)           { $this->data["address"]["phone"] = $value; }
  public function setPostalCode($value)      { $this->data["address"]["postalCode"] = $value; }
  public function setStateOrProvince($value) { $this->data["address"]["stateOrProvince"] = $value; }
  
  public function setCompanyName($value)             { $this->data["companyName"] = $value; }
  public function setDisplayOrganizationInfo($value) { $this->data["displayOrganizationInfo"] = $value; }
  public function setDisplayPersonalInfo($value)     { $this->data["displayPersonalInfo"] = $value; }
  public function setDisplayProfile($value)          { $this->data["displayProfile"] = $value; }
  public function setDisplayUsageHistory($value)     { $this->data["displayUsageHistory"] = $value; }
  public function setTitleInfo($value)               { $this->data["title"] = $value; }

  public function setFirstName($value)   { $this->data["userDetails"]["firstName"] = $value; } 
  public function setLastName($value)    { $this->data["userDetails"]["lastName"] = $value; }
  public function setMiddleName($value)  { $this->data["userDetails"]["middleName"] = $value; }
  public function setSuffixName($value)  { $this->data["userDetails"]["suffixName"] = $value; }
  public function setTitle($value)       { $this->data["userDetails"]["title"] = $value; }
  public function setUserName($value)    { $this->data["userDetails"]["userName"] = $value; }
}

?>