<?php
namespace App\Entity;

class Device
{
    protected $id;
    protected $name;
    protected $description;
    protected $attributes;
    protected $location;
    
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getAttributes() {
        return $this->attributes;
    }

    function getLocation() {
        return $this->location;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setAttributes($attributes) {
        $this->attributes = $attributes;
    }

    function setLocation($location) {
        $this->location = $location;
}
}
