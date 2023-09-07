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
        if(count($params) == 4) {            
            $this->option = $params['option'];
            $this->fileName = $params['filename'];
            $this->name = $params['name'];
            $this->price = $params['price'];
        } else {
            echo "Параметры некорректный.";
        }
    }
    
    protected function checkOption() {
        $res = false;    
        if(strcmp($this->option, strval("add")) === 0){
            $res = true;
        }
        return $res;
    }

    protected function checkFileName() {
        $res = false;
        if(strlen($this->fileName) <= 10 and strlen($this->fileName) >= 4) {                        
            $this->fileName = preg_replace('/\W/', '', $this->fileName);                        
            
            if(strlen($this->fileName) >= 4){            
                $this->validationData['filename'] = $this->fileName . ".txt";                            
                $res = true;
            } else {                
                echo "\n\nИмя файла некорректно.\n\n";
            } 

        } else {
            echo "\n\nТребование к имени файла максимум символов 10 и минимум 4 символов.\n\n";
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
        $checkFileName = $this->checkFileName();                        
        $checkName = $this->checkName($this->name);        
        $checkPrice = $this->checkPrice($this->price);                
        
        if($checkOption && $checkFileName && $checkName && $checkPrice) {
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