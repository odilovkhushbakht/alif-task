<?php

require_once('RepositoryFruits.php');
require_once('Fruits.php');
require_once('ValidationAdd.php');
require_once('ValidationChange.php');
require_once('ValidationDelete.php');



use Fruits\Fruits;
use RepositoryFruits\IRepositoryFruits;
use RepositoryFruits\RepositoryFruits;
use ValidationAdd\ValidationAdd;
use ValidationChange\ValidationChange;
use ValidationDelete\ValidationDelete;

$path = $argv[1];

switch ($argv[2]) {    
    
    case "add":
        if(count($argv) != 5){
            echo "\n\nСправка:\n\n  add     добавить запись в файл \"«имя файла» add «наименование» «цена»\"\n\n";
            break;
        }
        $params = $argv;
        $validationAdd = new ValidationAdd($params);
        $validationAdd->checkParamsOption();
        $data = $validationAdd->getValidationData();

        if(count($data) == 0) {            
            break;
        }        
                
        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->add($data['name'], $data['price']);
        break;
    
    case "change":
        if(count($argv) != 7){
            echo "\n\nСправка:\n\n  change  изменить запись в файле \"«имя файла» change «старая наименование» «старая цена» «новая наименование» «новая цена»\"\n\n";
            break;
        }
        $params = $argv;
        $validationChange = new ValidationChange($params);
        $validationChange->checkParamsOption();
        $data = $validationChange->getValidationData();        

        if(count($data) == 0) {            
            break;
        }
        
        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->change($data['name'], $data['price'], $data['newname'], $data['newprice']);
        break;
    
    case "del":
        if(count($argv) != 5){
            echo "\n\nСправка:\n\n  del     удалить запись из файла \"«имя файла» del «наименование» «цена»\"\n\n";
            break;
        }                
        $params = $argv;
        $validationDelete = new ValidationDelete($params);
        $validationDelete->checkParamsOption();
        $data = $validationDelete->getValidationData();        
        
        if(count($data) == 0) {            
            break;
        }
        
        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->delete($data['name'], $data['price']);        
        break;
    
    case "total":
        if(count($argv) != 3){
            echo "\n\nСправка:\n\n  total   общая сумма \"«имя файла» total\"\n\n";
            break;
        }
        $params = [];
        $params['filename'] = $argv[1];
        $params['option'] = $argv[2];        
        $repositoryFruits = new RepositoryFruits($path);                
        $fruits = new Fruits($repositoryFruits);
        $total = $fruits->total();
        echo "\n\nСумма: " . $total . "\n\n";
        break;
    
    default:
        echo <<<'EOD'

        Список действии:
        
            add     добавить запись в файл "«имя файла» add «наименование» «цена»"
            change  изменить запись в файле "«имя файла» change «старая наименование» «старая цена» «новая наименование» «новая цена»"
            del     удалить запись из файла "«имя файла» del «наименование» «цена»"
            total   общая сумма "«имя файла» total"


        EOD;
        break;

}