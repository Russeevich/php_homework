<?
    require('Services.php');

    interface iTariff
    {
        public function calcResult();

        public function addServices(iServices $service);
    }

    abstract class Tariff implements iTariff
    {
        protected $way;
        protected $time;
        protected $service;
        public $result = 0;

        public function __construct(int $way, int $time)
        {
            $this->way = $way;
            $this->time = $time;
        }

        public function getTime()
        {
            return $this->time;
        }
    }

    class BaseTariff extends Tariff
    {
        private $priceKm = 10;
        private $priceMin = 3;

        public function calcResult()
        {
            $this->result += $this->way * $this->priceKm + $this->time * $this->priceMin;
            return $this->result;
        }

        public function addServices(iServices $service)
        {
            $this->service = $service;
            $this->result += $this->service->getPrice(["time" => $this->time]);
        }
    }


    $obj = new BaseTariff(10, 20);
    $obj->addServices(new Gps());
    $obj->addServices(new Driver());
    echo $obj->calcResult();



?>