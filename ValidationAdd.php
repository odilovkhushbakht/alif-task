<?php
namespace ValidationAdd;


interface IValidationAdd {
    public function checkParamsOptionAdd();
    public function getValidationData();
}

class ValidationAdd implements IValidationAdd {

    private $validationData = [];
    private string $option;
    private string $fileName;
    private string $name;
    private float $price;

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
    
    private function checkOption() {
        $res = false;    
        if($this->option === 'change'){
            $res = true;
        }
        return $res;
    }

    private function checkFileName() {
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

    private function checkFile() {        
        $res = false;    
        if(file_exists($this->fileName)){
            $res = true;
        }
        return $res;
    }

    private function checkName() {
        $res = false;    
        if(strlen($this->name) >= 3) {
            $this->validationData['name'] = $this->name;
            $res = true;
        }
        return $res;
    }
    
    private function checkPrice() {
        $res = false;
        $this->validationData['price'] = floatval($this->price);        
        return $res;
    }
    
    public function checkParamsOptionAdd() {
        $res = false;            
        $checkOption = $this->checkOption();
        $checkFileName = $this->checkFileName();
        $checkFile = $this->checkFile();
        $checkName = $this->checkName();
        $checkPrice = $this->checkPrice();
        
        if(
            $checkOption and
            $checkFileName and
            $checkFile and
            $checkName and
            $checkPrice
        ) {
            $res = true;
        } else {
            $this->$validationData = [];
            echo "\n\nВалидация не пройдена.\n\n";
        }            
        
        return $res;
                
    }

    public function getValidationData() {
        return $this->validationData;
    }
}