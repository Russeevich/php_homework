<?
    interface iServices
    {
        public function getPrice($params);
    }

    class Gps implements iServices
    {
        private $timePay = 15;
        public function getPrice($params)
        {
            return ceil($params['time'] / 60) * $this->timePay;
        }
    }

    class Driver implements iServices
    {
        private $pay = 100;
        public function getPrice($params)
        {
            return $this->pay;
        }
    }