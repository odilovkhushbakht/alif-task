<?php

require_once('RepositoryFruits.php');
require_once('Fruits.php');



use Fruits\Fruits;
use RepositoryFruits\IRepositoryFruits;
use RepositoryFruits\RepositoryFruits;

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

print_r($argv);
switch ($argv[2]) {    
    
    case "add":
        $params = $argv;
        checkParamsAddOption($params);
        
        $fileName = $argv[1];
        $path = dirname(__FILE__) . "/" . $fileName . ".txt";
        $name = $argv[3];
        $price = $argv[4];
        
        $repositoryFruits = new RepositoryFruits($path);        
        $d = new Fruits($repositoryFruits);
        $d->add($name, $price);        

        break;
    
    case "change":      
        $params = $argv;  
        checkParamsChangeOption($params);
        
        $fileName = $argv[1];
        $path = dirname(__FILE__) . "/" . $fileName . ".txt";
        $oldName = $argv[3];
        $oldPrice = $argv[4];
        $newName = $argv[5];
        $newPrice = $argv[6];

        $repositoryFruits = new RepositoryFruits($path);        
        $d = new Fruits($repositoryFruits);
        $d->change($oldName, $oldPrice, $newName, $newPrice);
        break;
    
    case "del":
        print_r("del\n");
        break;
    
    default:
        echo "\n\nСписок действии:\n\n  add добавить запись в файл  \"имяфайла add «Наименование» — «Цена»\"\n  change изменить запись в файле \"имяфайла change старая запись новая запись\"\n  del удалить запись из файла \"имяфайла del запись\"\n\n";
        break;

}