<?
    const FILENAME = 'purchase.json';

    class Purchase
    {
        private $name;
        private $phone;
        private $email;
        private $street;
        private $home;
        private $part;
        private $appt;
        private $floor;
        private $comment;
        private $payment;
        private $callback;

        private $file;

        public function __construct(array $data)
        {
            foreach($data as $key => $value){
                $this->$key = $value;
            }   
        }

        private function printData(array $user)
        {
            $lastPurchase = $user['purchase'][sizeof($user['purchase']) - 1];
            echo "
            Спасибо, ваш заказ будет доставлен по адресу: '".$lastPurchase['address']."'<br>
            Номер вашего заказа: ". $lastPurchase['id'] ."r<br>
            Это ваш ". sizeof($user['purchase']). " заказ!
            ";
        }

        private function getAddr()
        {
            return $this->street . ' ' . $this->home . ' ' . $this->part . ' ' . $this->appt . ' ' . $this->floor;
        }

        private function saveFile()
        {
            file_put_contents(FILENAME, json_encode($this->file));
        }

        private function addNew()
        {
            $user = array(
                "id" => uniqid(),
                "email" => $this->email,
                "purchase" => [array(
                    "id" => uniqid(),
                    "address" => $this->getAddr(),
                    "name" => $this->name,
                    "phone" => $this->phone,
                    "date" => date("d.m.y H:i:s")
                )]
            );

            array_push($this->file, $user);
            $this->saveFile();
            $this->printData($user);
        }

        private function addOld($index)
        {
            $user = array(
                "id" => $this->file[$index]['id'],
                "email" => $this->file[$index]['email'],
                "purchase" => array_merge(
                    $this->file[$index]['purchase'],
                    [
                    array(
                    "id" => uniqid(),
                    "name" => $this->name,
                    "phone" => $this->phone,
                    "address" => $this->getAddr(),
                    "date" => date("d.m.y H:i:s")
                    )
                ])
            );

            $this->file[$index] = $user;
            $this->saveFile();
            $this->printData($user);
        }

        public function add()
        {
            $this->getFile();
            $userIndex = $this->checkUser();

            if($userIndex >= 0){
                $this->addOld($userIndex);
            } else {
                $this->addNew();
            }
        }

        private function fileExits()
        {
            if(!file_exists(FILENAME)){
                $file = fopen(FILENAME, 'w');
                fwrite($file, "[]");
                fclose($file);
            }
        }

        private function getFile()
        {
            $this->fileExits();
            $this->file = json_decode(file_get_contents(FILENAME), true);
        }

        private function checkUser()
        {
            $search = array_map(function($data) {return $data['email'];}, $this->file);
            $index = array_search($this->email, $search);
            if(is_numeric($index)){
                return $index;
            } else {
                return -1;
            }
        }
    }



$purchase = new Purchase($_POST);

$purchase->add();