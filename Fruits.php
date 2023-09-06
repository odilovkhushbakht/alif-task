<?php

namespace Fruits;


require_once('RepositoryFruits.php');


use repository\IRepositoryFruits;


interface FruitsActions {
    
    public function add(string $fileName, string $name, float $price);
    public function change($name, $price);
    public function delete($name);
    public function total();
    
}

class Fruits implements FruitsActions {
    
    private $repo;

    public function __construct($repository) {        
        $this->$repo = $repository;
    }

    public function add(string $fileName, string $name, float $price) {                        
        $this->$repo->add($fileName, $name, $price);
    }

    public function change($name, $price) {

    }

    public function delete($name) {

    }

    public function total() {

    }

}