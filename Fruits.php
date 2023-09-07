<?php

namespace Fruits;


require_once('RepositoryFruits.php');


use repository\IRepositoryFruits;


interface FruitsActions {
    
    public function add(string $name, float $price);
    public function change(string $oldName, float $oldPrice, string $newName, float $newPrice);
    public function delete(string $name, float $price);
    public function total();
    
}

class Fruits implements FruitsActions {
    
    private $repo;

    function __construct($repository) {        
        $this->$repo = $repository;
    }

    public function add(string $name, float $price) {    
        $text = $this->textProcessing($name, $price);                    
        $res = $this->$repo->add($text);
        if($res) {
            echo "\nЗапись успешно добавлено в файл.\n";
            return;
        }
        echo "\nЗапись не добавлено в файл.\n";
    }

    public function change(string $oldName, float $oldPrice, string $newName, float $newPrice) {
        $oldText = $this->textProcessing($oldName, $oldPrice);
        $newText = $this->textProcessing($newName, $newPrice);
        $res = $this->$repo->change($oldText, $newText);
        if($res) {
            echo "\nЗапись успешно изменено в файле.\n";
            return;
        }
        echo "\nЗапись не изменено в файле.\n\n";
    }

    public function delete(string $name, float $price) {
        $text = $this->textProcessing($name, $price);
        $res = $this->$repo->delete($text);
        if($res) {
            echo "\nЗапись успешно удалено в файле.\n";
            return;
        }
        echo "\nЗапись не удалено в файле.\n\n";
    }

    public function total() {

    }
    
    private function textProcessing(string $name, float $price) {
        return $name.' -- '.$price . PHP_EOL;
    }

}