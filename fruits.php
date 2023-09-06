interface FruitsActions {
    
    public function add(string $name, int $price);
    public function change($name, $price);
    public function delete($name);
    public function total();
    
}

class Fruits implements FruitsActions {

    function __construct() {

    }

    public function add(string $name, int $price) {

    }

    public function change($name, $price) {

    }

    public function delete($name) {

    }

    public function total() {

    }

}