<?php

namespace Docusign\Model;

class Document extends Model {
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
