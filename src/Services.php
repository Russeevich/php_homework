<?
    interface iServices
    {
        public function getPrice($params);
    }

    class Gps implements iServices
    {
        const PRICE_PER_HOUR = 15;
        public function getPrice($params)
        {
            return ceil($params['time'] / 60) * self::PRICE_PER_HOUR;
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