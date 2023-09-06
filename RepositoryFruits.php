<?php

namespace RepositoryFruits;


interface IRepositoryFruits {

    public function add(string $fileName, string $name, float $price);
    public function change(string $name, int $price);
    public function delete(string $name);

}

class RepositoryFruits implements IRepositoryFruits {
    
    private $path;

    function __construct($path) {
        $this->path = $path;
    }

    public function setPath($path) {
        $this->path = $path;        
    }

    public function getPath($path) {
        return $this->path;
    }

    public function add(string $fileName, string $name, float $price) {
        $text = $name.' -- '.$price . PHP_EOL;        
        $path = $this->path . '/' . $fileName . '.txt';        
        file_put_contents($path, $text, FILE_APPEND);
    }

    public function change(string $name, int $price) {
        
    }

    public function delete(string $name) {

    }
    
}