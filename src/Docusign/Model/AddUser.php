<?php

namespace Docusign\Model;

/**
* This class encapsulates the possible parameters that can be supplied when creating a user 
* membership within an account.
*/
class AddUser extends Model {
  
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