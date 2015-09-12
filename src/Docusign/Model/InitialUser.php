<?php

namespace Docusign\Model;

class InitialUser extends Model {
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
