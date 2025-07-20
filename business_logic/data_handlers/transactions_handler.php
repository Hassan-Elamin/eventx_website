<?php
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/models/ticket.php");
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/models/transaction.php");
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/repositories/tickets_repo.php");
include ("{$_SERVER['DOCUMENT_ROOT']}/eventx_website/data_access/repositories/transactions_repo.php");

class TransactionsHandler extends TransactionsRepo 
{

    protected $tickets_repo ;

    public function __construct(mysqli $database)
    {
        parent::__construct($database);
        $this->tickets_repo = new TicketsRepo();
    }

    function getTicket($eid){
        $data_row = $this->tickets_repo->getTicket($eid);
        $ticket_model = Ticket::fromSqlRow($data_row);
        return $ticket_model ;
    }
    

}