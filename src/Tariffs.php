<?
    require('Services.php');

    interface iTariff
    {
        public function calcResult();

        public function addServices(iServices $service);
    }

    abstract class Tariff implements iTariff
    {
        private $way;
        private $time;
        private $services;

        public function __construct(float $way, float $time)
        {
            $this->way = $way;
            $this->time = $time;
        }

        public function getTime()
        {
            return $this->time;
        }

        public function addServices(iServices $service)
        {
            $this->services[] = $service;
        }

        public function getWay()
        {
            return $this->way;
        }

        public function getServices()
        {
            return $this->services;
        }
    }

    class BaseTariff extends Tariff
    {
        const PRICE_KM = 10;
        const PRICE_PER_MINUTE = 3;

        public function calcResult()
        {
            $result = $this->getWay() * self::PRICE_KM + $this->time * self::PRICE_PER_MINUTE;

            foreach($this->getServices() as $value){
                $result += $value->getPrice(["time" => $this->time]);
            }

            return $result;
        }
    }


    $obj = new BaseTariff(10, 20);
    $obj->addServices(new Gps());
    $obj->addServices(new Driver());
    echo $obj->calcResult();



?>