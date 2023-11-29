<?php

namespace App\Repositories;

use App\Models\Invoice;
use Cookie;
class InvoiceRepository {
private $invoice;
public function __construct(Invoice $invoice){
    $this->invoice=$invoice;
}

    public function getAllInvoices()
    {
     return $this->invoice->all();
    }

    public function getInvoiceById($id)
    {
        return $this->invoice->find($id);
    }
    public function getInvoicesByCorporate()
    { return $this->invoice->select('*')->where('agency_id',auth('corporate')->user()->agency_id)->get();

    }
    public function getInvoicesByClient()
    {  $invoices=$this->invoice->where('client_id','=',json_decode(Cookie::get('client'))->id)->get();
        return $invoices;
    }

    public function createInvoice($collection = [])
    {
        $invoice = new Invoice();
        $invoice->name = $collection['name'];
        $invoice->send_date = date('Y-m-d');
        $invoice->limit_date = $collection['limit_date'];
        $invoice->payed =0;
        $invoice->bill_amount = intval($collection['bill_amount']);
        $invoice->client_id = intval($collection['client_id']);
        $invoice->agency_id =auth('corporate')->user()->agency_id;
        $invoice->save();

    }

    public function UpdateInvoice($id,$collection=[])
    {        $invoice = $this->invoice->find($id);
        $invoice->name = $collection['name'];
        $invoice->send_date = $collection['send_date'];
        $invoice->limit_date = $collection['limit_date'];
        $invoice->payed = $collection['payed'];
        $invoice->bill_amount = $collection['bill_amount'];
        $invoice->client_id = $collection['client_id'];
        $invoice->agency_id = $collection['agency_id'];
        $invoice->save();
    }
public function pay(Invoice $invoice){
   $invoice->payed=1;
   $invoice->save();
}
    public function DeleteInvoice($id)
    {
      $this->invoice->find($id)->delete();
    }
}
