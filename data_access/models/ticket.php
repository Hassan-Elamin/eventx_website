<?php


// tickets table
class Ticket
{
    public $eid;
    public $price;
    public $rules;
    public $expire_date;

    public function __construct($eid, $price, $rules,$expire_date)
    {
        $this->eid = $eid;
        $this->price = $price;
        $this->rules = $rules;
        $this->expire_date = $expire_date ;
    }

    public static function fromSqlRow($data)
    {
        return new Ticket(
            $data['eid'],
            $data['price'],
            $data['rules'],
            $data['expire_date'] ?? ''
        );
    }
}
