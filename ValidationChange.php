<?php
namespace ValidationChange;

require_once('ValidationAdd.php');

use ValidationAdd\ValidationAdd;


class ValidationChange extends ValidationAdd {

    protected string $newName;
    protected float $newPrice;

    function __construct($params) {
        if(count($params) == 6) {            
            $this->option = $params['option'];
            $this->fileName = $params['filename'];
            $this->name = $params['name'];
            $this->price = $params['price'];
            $this->newName = $params['newname'];
            $this->newPrice = $params['newprice'];
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
        if(file_exists($this->fileName . ".txt")){
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
        $checkFileName = $this->checkFileName();                        
        $checkFile = $this->checkFile(); 
        $checkName = $this->checkName();        
        $checkPrice = $this->checkPrice();        
        $checkNewName = $this->checkNewName();        
        $checkNewPrice = $this->checkNewPrice();        
        
        if(
            $checkOption and
            $checkFileName and
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