<?
    interface iServices
    {
        public function add(Tariff $tariff);
    }

    class Gps implements iServices
    {
        private $timePay = 15;
        public function add(Tariff $tariff)
        {
            $tariff->result += ceil($tariff->getTime() / 60) * $this->timePay;
        }
    }

    class Driver implements iServices
    {
        private $pay = 100;
        public function add(Tariff $tariff)
        {
            $tariff->result += $this->pay;
        }
    }