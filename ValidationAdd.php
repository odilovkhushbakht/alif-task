<?php
namespace ValidationAdd;


interface IValidationAdd {
    public function checkParamsOption();
    public function getValidationData();
}

class ValidationAdd implements IValidationAdd {

    protected $validationData = [];
    protected string $option;
    protected string $fileName;
    protected string $name;
    protected float $price;

    function __construct($params) {
        if(count($params) == 5) {
            $this->option = $params[2];
            $this->fileName = $params[1];
            $this->name = $params[3];
            $this->price = $params[4];
        } else {
            echo "Параметры некорректный.";
        }
    }
    
    protected function checkOption() {
        $res = false;    
        if(strcmp($this->option, "add") === 0){
            $res = true;
        }
        return $res;
    }

    protected function checkName() {
        $res = false;    
        if(strlen($this->name) >= 3) {
            $this->validationData['name'] = $this->name;
            $res = true;
        }
        return $res;
    }
    
    protected function checkPrice() {
        $res = true;
        $this->validationData['price'] = floatval($this->price);        
        return $res;
    }
    
    public function checkParamsOption() {
        $res = false;            
        $checkOption = $this->checkOption();                                        
        $checkName = $this->checkName($this->name);        
        $checkPrice = $this->checkPrice($this->price);                
        
        if($checkOption && $checkName && $checkPrice) {
            $res = true;
        } else {
            $this->validationData = [];
            echo "\n\nВалидация не пройдена.\n\n";
        }            
        
        return $res;
                
    }

    public function getValidationData() {
        return $this->validationData;
    }
}