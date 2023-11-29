<?php

namespace App\Http\Controllers;

use App\Repositories\ContractRepository;

use App\Http\Requests\ContractRequest;

class ContractController extends Controller
{ private $contract;
    private $request;
    public function __construct(ContractRepository $contract)
    {
        $this->contract = $contract;
    }
    public function index(){
        $contracts=$this->contract->getAllContracts();
        return $contracts;
    }
    public function store(ContractRequest $request){
         $name=$request->get('name');
            $send_date=$request->get('send_date');
            $period=$request->get('period');
            $bill_amount = $request->get('bill_amount');
            $agency_id = $request->get('agency_id');
            $client_id= $request->get('client_id');
            $inputs=[
                'name'=>$name,
                'send_date'=> $send_date,
                'period'=> $period,
                'bill_amount'=> $bill_amount ,
                'agency_id'=>$agency_id ,
                'client_id'=> $client_id
            ];


        $this->contract->createContract($inputs);
        return ['success'=>'Contract Created Successfully'];


    }
    public function show($id){
        $this->contract->getContractById($id);

    }
    /*  public function edit(Request $request,$id){


      }*/
    public function getContractByCorporate(){
       return $this->contract->getContractByCorporate();
    }
    public function getContractByClient(){
      return  $this->contract->getContractByClient();
    }
    public function update($id,ContractRequest $request){
        $name=$request->get('name');
        $send_date=$request->get('send_date');
        $period=$request->get('period');
        $bill_amount = $request->get('bill_amount');
        $agency_id = $request->get('agency_id');
        $client_id= $request->get('client_id');
        $inputs=[
            'name'=>$name,
            'send_date'=> $send_date,
            'period'=> $period,
            'bill_amount'=> $bill_amount ,
            'agency_id'=>$agency_id ,
            'client_id'=> $client_id
        ];
        $this->contract->UpdateContract($id,$this->request->validated());
        return ['success'=>'Contract Updated Successfully'];


    }
    public function destroy($id){
        $this->contract->DeleteContract($id);
        return ['success'=>'Contract Deleted Successfully'];



    }
    /*public function index(){
        $contracts=Contract::all();
        return $contracts;
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'string|required',
            'send_date'=>'date|required',
            'period'=>'integer|required',
            'bill_amount'=>'integer|required',
            'agency_id'=>'integer|required',
            'client_id'=>'integer|required'

        ]);
        $contract=new Contract([
            'name'=>$request->get('name'),
            'send_date'=>$request->get('send_date'),
            'period'=>$request->get('period'),
            'bill_amount' => $request->get('bill_amount'),
            'agency_id' => $request->get('agency_id'),
            'client_id' => $request->get('client_id'),


        ]);
        $contract->save();
        return(["success"=>"contract saved"]);


    }
    public function show($id){
        $contract=Contract::find($id);
        return $contract;
    }
      public function edit(Request $request,$id){


      }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'string|required',
            'send_date'=>'date|required',
            'period'=>'integer|required',
            'bill_amount'=>'integer|required',
            'client_id'=>'integer|required',
            'agency_id'=>'integer|required'
        ]);
        $contract=$this->show($request,$id);
        $contract->name=$request->get('name');
        $contract->send_date=$request->get('send_date');
        $contract->period=$request->get('period');
        $contract->bill_amount = $request->get('bill_amount');
        $contract->client_id = $request->get('client_id');
        $contract->agency_id = $request->get('agency_id');
        $contract->save();
        return(["success"=>"contract updated"]);

    }
    public function destroy($id){
        $contract=$this->show($id);
        $contract->delete();
        return(["success"=>"contract deleted"]);
    }*/
}
