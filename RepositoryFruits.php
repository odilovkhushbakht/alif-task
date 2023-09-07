<?php

namespace RepositoryFruits;


interface IRepositoryFruits {

    public function add(string $text);
    public function change(string $oldText, string $newText);
    public function delete(string $text);

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

    public function add(string $text) {        
        $res = file_put_contents($this->path, $text, FILE_APPEND);
        echo "\n\nПуть к файлу: " . $this->path . "\n\n";        
        return $res;
    }

    public function change(string $oldText, string $newText) {
        $res = false;
        $contentArray = file($this->path);        
        $eleNum = array_search($oldText, $contentArray, true);        
        if($eleNum !== false){            
            $contentArray[$eleNum] = $newText;            
            $res = file_put_contents($this->path, $contentArray);
            return $res;
        } else {
            echo "\nЗапись не найден.\n";
            return $res;
        }        
    }

    public function delete(string $text) {
        $res = false;
        $contentArray = file($this->path);        
        $eleNum = array_search($text, $contentArray, true);        
        if($eleNum !== false){            
            unset($contentArray[$eleNum]);   
            $res = file_put_contents($this->path, $contentArray);
            return $res;
        } else {
            echo "\nЗапись не найден.\n";
            return $res;
        }
    }
    
}