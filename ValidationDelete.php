<?php

namespace ValidationDelete;

require_once('ValidationAdd.php');

use ValidationAdd\ValidationAdd;


class ValidationDelete extends ValidationAdd {

    protected function checkOption() {
        $res = false;    
        if(strcmp($this->option, strval("del")) === 0){
            $res = true;
        }
        return $res;
    }
    
    protected function checkFile() {
        $res = false;       
        if(file_exists($this->fileName)){
            $res = true;
        }
        return $res;
    }

    public function checkParamsOption() {
        $res = false;            
        $checkOption = $this->checkOption();                
        $checkFile = $this->checkFile();                        
        $checkName = $this->checkName($this->name);        
        $checkPrice = $this->checkPrice($this->price);                
        
        if($checkOption && $checkFile && $checkName && $checkPrice) {
            $res = true;
        } else {
            $this->validationData = [];
            echo "\n\nВалидация не пройдена.\n\n";
        }            
        
        return $res;                
    }

}