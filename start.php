<?php

require_once('RepositoryFruits.php');
require_once('Fruits.php');



use Fruits\Fruits;
use RepositoryFruits\IRepositoryFruits;
use RepositoryFruits\RepositoryFruits;

function checkNameFile() {
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

checkNameFile();

switch ($argv[2]) {    
    
    case "add":        
        
        $fileName = $argv[1];
        $name = $argv[3];
        $price = $argv[4];

        $repositoryFruits = new RepositoryFruits(dirname(__FILE__));        
        $d = new Fruits($repositoryFruits);
        $d->add($fileName, $name, $price);        

        break;
    
    case "change":
        print_r("change\n");
        break;
    
    case "del":
        print_r("del\n");
        break;
    
    default:
        echo "\n\nСписок действии:\n\n  add добавить запись в файл  \"имяфайла add «Наименование» — «Цена»\"\n  change изменить запись в файле \"имяфайла change старая запись новая запись\"\n  del удалить запись из файла \"имяфайла del запись\"\n\n";
        break;

}