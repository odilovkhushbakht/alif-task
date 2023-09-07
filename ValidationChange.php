<?php
namespace ValidationChange;

require_once('ValidationAdd.php');

use ValidationAdd\ValidationAdd;


class ValidationChange extends ValidationAdd {

    private string $newName;
    private float $newPrice;

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
}