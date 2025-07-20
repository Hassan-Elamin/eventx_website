<?php 

class TransactionsRepo {
    private $database ;

    public function __construct($database){
        $this->database = $database;
    } 

    public function getTransaction($tid) {
        $sql = "SELECT * FROM transactions WHERE tid = $tid";
        $response = $this->database->query($sql);
        return $response->fetch_assoc();
    }

    public function getTransactionsByUserId($uid) {
        $sql = "SELECT * FROM transactions WHERE uid = $uid";
        $response = $this->database->query($sql);
        return $response->fetch_all();
    }

    public function prepareTransaction ($eid , $uid ): object | string {
        $sql = "CALL prepare_transaction_data($eid , $uid)";

        $response = $this->database->query($sql );

        if ($response->num_rows > 0) {
            return $response->fetch_object();
        } else {
            return 'nothing found';
        }
    }

    public function createTransaction($uid, $eid , $total) {
        $date = date("Y-m-d H");
        $sql = "INSERT INTO transactions (uid, eid, transaction_date, total) VALUES ($uid, $eid, '$date', $total)";
        if ($this->database->query($sql) === TRUE) {
            return $this->database->insert_id;
        } else {
            return "Error: ". $sql. "<br>". $this->database->error;
        }
    }
}