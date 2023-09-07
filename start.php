<?php

require_once('RepositoryFruits.php');
require_once('Fruits.php');
require_once('ValidationAdd.php');



use Fruits\Fruits;
use RepositoryFruits\IRepositoryFruits;
use RepositoryFruits\RepositoryFruits;
use ValidationAdd\ValidationAdd;


function checkParamsDeleteOption($params) {
    return true;
}

function checkParamsChangeOption($params) {
    return true;
}

function checkParamsAddOption($params) {
    $res = false;
    if(count($params) == 5) {
        $res = true;
    }
    return $res;
}

function checkNameFile($fileName) {   
    $res = false;
    if(is_string($fileName)){        
        $res = true;
    }
    return $res;
}

function checkFile($path) {
    $res = false;    
    if(file_exists($path)){
        $res = true;
    }
    return $res;
}

function checkOldData() {
    $res = false;
    if(
        !empty($argv[1]) and
        isset($argv[1]) and
        is_string($argv[1])
    ){
        $res = true;
    }
    return $res;
}


switch ($argv[2]) {    
    
    case "add":        
        $params = [];
        $params['filename'] = $argv[1];
        $params['option'] = $argv[2];
        $params['name'] = $argv[3];
        $params['price'] = $argv[4];
        $validationAdd = new ValidationAdd($params);
        $validationAdd->checkParamsOptionAdd();
        if(count($validationAdd->getValidationData()) == 0) {            
            break;
        }
        
        $data = $validationAdd->getValidationData();                
        $path = dirname(__FILE__) . "/" . $data['filename'];        
        
        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->add($data['name'], $data['price']);        

        break;
    
    case "change":      
        $params = $argv;  
        if(!checkParamsChangeOption($params)) {
            break;
        }
        
        $fileName = $argv[1];
        $path = dirname(__FILE__) . "/" . $fileName . ".txt";
        $oldName = $argv[3];
        $oldPrice = $argv[4];
        $newName = $argv[5];
        $newPrice = $argv[6];

        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->change($oldName, $oldPrice, $newName, $newPrice);
        break;
    
    case "del":        
        $params = $argv;  
        checkParamsDeleteOption($params);
        
        $fileName = $argv[1];
        $path = dirname(__FILE__) . "/" . $fileName . ".txt";        
        $name = $argv[3];
        $price = $argv[4];

        $repositoryFruits = new RepositoryFruits($path);        
        $d = new Fruits($repositoryFruits);
        $d->delete($name, $price);
        break;
    
    default:
        echo "\n\nСписок действии:\n\n  add добавить запись в файл  \"имяфайла add «Наименование» — «Цена»\"\n  change изменить запись в файле \"имяфайла change старая запись новая запись\"\n  del удалить запись из файла \"имяфайла del запись\"\n\n";
        break;

}