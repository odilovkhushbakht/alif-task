<?php
namespace ValidationChange;

require_once('ValidationAdd.php');

use ValidationAdd\ValidationAdd;


class ValidationChange extends ValidationAdd {

    protected string $newName;
    protected float $newPrice;

    function __construct($params) {        
        if(count($params) == 7) {            
            $this->option = $params[2];
            $this->fileName = $params[1];
            $this->name = $params[3];
            $this->price = $params[4];
            $this->newName = $params[5];
            $this->newPrice = $params[6];
        } else {
            echo "Параметры некорректный.";
        }
    }

    protected function checkOption() {
        $res = false;    
        if(strcmp($this->option, strval("change")) === 0){
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

    protected function checkNewName() {
        $res = false;    
        if(strlen($this->newName) >= 3) {
            $this->validationData['newname'] = $this->newName;
            $res = true;
        }
        return $res;
    }
    
    protected function checkNewPrice() {
        $res = true;
        $this->validationData['newprice'] = floatval($this->newPrice);        
        return $res;
    }

    public function checkParamsOption() {
        $res = false;                   
        $checkOption = $this->checkOption();                                        
        $checkFile = $this->checkFile(); 
        $checkName = $this->checkName();        
        $checkPrice = $this->checkPrice();        
        $checkNewName = $this->checkNewName();        
        $checkNewPrice = $this->checkNewPrice();        
        
        if(!$checkFile){
            echo "\n\nФайл не найдено.\n\n";
        }

        if(
            $checkOption and            
            $checkFile and
            $checkName and
            $checkPrice and
            $checkNewName and
            $checkNewPrice         
        ) {
            $res = true;
        } else {
            $this->validationData = [];
            echo "\n\nВалидация не пройдена.\n\n";
        }            
        
        return $res;
                
    }
}