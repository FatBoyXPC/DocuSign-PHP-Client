<?php

namespace Docusign\Model;


class TemplateRole extends Model {
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
