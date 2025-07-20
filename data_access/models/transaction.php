<?php

class Transaction
{
    public $tid;
    public $eid;
    public $uid;
    public $date;

    public $total
    ;

    public function __construct($tid, $eid, $uid, $date, $total)
    {
        $this->tid = $tid;
        $this->eid = $eid;
        $this->uid = $uid;
        $this->date = $date;
        $this->total = $total;
    }

    public static function fromRow($row)
    {
        return new Transaction($row['tid'], $row['eid'], $row['uid'], $row['transaction_date'], $row['total']);
    }


}