<?php

namespace Docusign\Model;

/**
* This class encapsulates the possible parameters that can be supplied when modifying a 
* user profile.
*/
class UserProfile extends Model {
  
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
