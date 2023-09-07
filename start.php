<?php

require_once('RepositoryFruits.php');
require_once('Fruits.php');
require_once('ValidationAdd.php');
require_once('ValidationChange.php');



use Fruits\Fruits;
use RepositoryFruits\IRepositoryFruits;
use RepositoryFruits\RepositoryFruits;
use ValidationAdd\ValidationAdd;
use ValidationChange\ValidationChange;


switch ($argv[2]) {    
    
    case "add":        
        $params = [];
        $params['filename'] = $argv[1];
        $params['option'] = $argv[2];
        $params['name'] = $argv[3];
        $params['price'] = $argv[4];
        $validationAdd = new ValidationAdd($params);
        $validationAdd->checkParamsOption();
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
        $params = [];
        $params['filename'] = $argv[1];
        $params['option'] = $argv[2];
        $params['name'] = $argv[3];
        $params['price'] = $argv[4];
        $params['newname'] = $argv[3];
        $params['newprice'] = $argv[4];
        $validationChange = new ValidationChange($params);
        $validationChange->checkParamsOption();
        
        if(count($validationChange->getValidationData()) == 0) {            
            break;
        }
        
        $data = $validationChange->getValidationData();
        $path = dirname(__FILE__) . "/" . $data['filename'];
        
        $repositoryFruits = new RepositoryFruits($path);        
        $fruits = new Fruits($repositoryFruits);
        $fruits->change($data['name'], $data['price'], $data['newname'], $data['newprice']);
        break;
    
    case "del":        
        $params = $argv;  
        #checkParamsDeleteOption($params);
        
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