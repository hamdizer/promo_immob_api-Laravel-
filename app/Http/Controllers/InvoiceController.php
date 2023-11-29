<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContractRequest;
use App\Repositories\ContractRepository;
use Cookie;
use App\Http\Requests\InvoiceRequest;
use App\Repositories\InvoiceRepository;

class InvoiceController extends Controller
{private $invoice;
    private $contract;
    public function __construct(InvoiceRepository $invoice ,ContractRepository $contract)
    {
        $this->invoice = $invoice;
        $this->contract=$contract;
    }
    public function index(){
        $invoices=$this->invoice->getAllInvoices();
        return $invoices;
    }
    public function getInvoicesByCorporate(){
       return $this->invoice->getInvoicesByCorporate();
    }
    public function getInvoicesByClients(){
        $invoices=$this->invoice->getInvoicesByClient();
        return $invoices;
    }
    public function store(InvoiceRequest $request){
       $name = $request->input('name');
        $limit_date = $request->input('limit_date');
        $bill_amount = $request->input('bill_amount');
        $agency_id = $request->input('agency_id');
        $client_id=$request->input('client_id');

        $inputs=[
             'name'=>$name,
        'bill_amount'=> $bill_amount,
            'limit_date'=> $limit_date,
            'agency_id'=>$agency_id,
            'client_id'=>$client_id

        ];
        $this->invoice->createInvoice($inputs);
        return ['success'=>'Invoice Created Successfully'];


    }
    public function show($id){
       return $this->invoice->getInvoiceById($id);

    }
    public function update($id,InvoiceRequest $request){
        $name = $request->input('name');
        $send_date = $request->input('send_date');
        $payed = $request->boolean('payed');
        $bill_amount = $request->input('bill_amount');
        $agency_id = $request->input('agency_id');
        $client_id = $request->input('client_id');
        $inputs=[
            'name'=>$name,
            'send_date'=>$send_date,
            'payed'=>$payed,
            'bill_amount'=> $bill_amount,
            'agency_id'=>$agency_id,
            'client_id' =>$client_id
        ];
        $this->invoice->UpdateInvoice($id,$inputs);
        return ['success'=>'Invoice Updated Successfully'];


    }
    public function pay($id,ContractRequest $request){
        $invoice=$this->invoice->getInvoiceById($id);
        if($invoice->client_id!=json_decode(Cookie::get('client'))->id){
            return response()->json(['error'=>'invoice is not yours'],401);
        }
        else
        {
            $this->invoice->pay($invoice);
            $inputscontract=[
                'name_contract'=>$request->input('name_contract'),
                'period'=>$request->input('period'),
                'agency_id'=>$this->invoice->getInvoiceById($id)->agency_id


            ];
            $this->contract->createContract($inputscontract);
            return response()->json(['success'=>'invoice payed'],200);
        }

    }
    public function destroy($id){
        $this->invoice->DeleteInvoice($id);
        return ['success'=>'Invoice Deleted Successfully'];



    }


}


