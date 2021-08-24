<?
    const USER_LENGTH = 50;

    class User {
        public function __construct(int $id, string $name, int $age){
            $this->id = $id;
            $this->name = $name;
            $this->age = $age;
        }

        public static function getRandomName($names){
            return $names[rand(0, sizeof($names) - 1)];
        }

        public static function getRandomAge(){
            return rand(18, 45);
        }
    }


    function task1(){
        $arr = array();
        $names = ['John', 'Carry', 'Nick', 'Claus', 'Mike'];

        for($i=0; $i < USER_LENGTH; $i++){
            $name = User::getRandomName($names);
            $age = User::getRandomAge();

            array_push($arr, new User($i, $name, $age));
        }

        file_put_contents('users.json', json_encode($arr));

        $newArr = json_decode(file_get_contents('users.json'), JSON_OBJECT_AS_ARRAY);

        $partAge = 0;

        $calcName = array();

        foreach($newArr as $value){
            if(array_key_exists($value['name'], $calcName)){
                $calcName[$value['name']] = $calcName[$value['name']] + 1;
            } else {
                $calcName[$value['name']] = 1;
            }
            $partAge += $value['age'];
        }

        $partAge /= USER_LENGTH;

        echo "Средний возраст: $partAge";

        echo "<br>";

        echo "Количество имен: <br>";

        foreach($calcName as $key => $value){
            echo "$key: $value<br>";
        }
    }



?>