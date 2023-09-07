<?php

namespace RepositoryFruits;


interface IRepositoryFruits {

    public function add(string $text);
    public function change(string $oldText, string $newText);
    public function delete(string $text);
    public function all();

}

class RepositoryFruits implements IRepositoryFruits {
    
    private $path;

    function __construct($path) {
        $this->path = $path;
    }

    public function add(string $text) {
        $res = false;
        
        if(file_exists($this->path)) {        
            $contentArray = file($this->path, FILE_SKIP_EMPTY_LINES);
            $eleNum = array_search($text, $contentArray, true);        
            
            if($eleNum !== false) {
                echo "\n\nЗапись существует.\n\n";
                return $res;
            }           
        }

        $res = file_put_contents($this->path, $text, FILE_APPEND);        
        return $res;
    }

    public function change(string $oldText, string $newText) {
        $res = false;
        $contentArray = file($this->path, FILE_SKIP_EMPTY_LINES);        
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
        $contentArray = file($this->path, FILE_SKIP_EMPTY_LINES);        
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

    public function all() {        
        $res = [];
        if(file_exists($this->path)) {
            $res = file($this->path, FILE_SKIP_EMPTY_LINES);
        }
        return $res;
    }
    
}