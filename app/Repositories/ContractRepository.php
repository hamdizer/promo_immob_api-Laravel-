<?php

namespace App\Repositories;
use App\Models\Contract;
use Cookie;
class ContractRepository
{  private $contract;
    public function __construct(Contract $contract){
        $this->contract=$contract;
    }

    public function getAllContracts()
    {
        return $this->contract->all();
    }

    public function getContractById($id)
    {
        return $this->contract->find($id);
    }
    public function getContractByCorporate()
    { return $this->contract->select('*')->where('agency_id',auth('corporate')->user()->agency_id)->get();

    }
    public function getContractByClient()
    {  $invoices=$this->contract->where('client_id','=',json_decode(Cookie::get('client'))->id)->get();
        return $invoices;
    }
    public function createContract($collection = [])
    {
        $contract = new Contract();
        $contract->name_contract = $collection['name_contract'];
        $contract->send_date = date('Y-m-d');
        $contract->period = intval($collection['period']);
        $contract->client_id = json_decode(Cookie::get('client'))->id;
        $contract->agency_id = intval($collection['agency_id']);
        $contract->save();    }

    public function UpdateContract($id,$collection=[])
    {   $contract=$this->contract->find($id);
        $contract->send_date = $collection['send_date'];
        $contract->period = $collection['period'];
        $contract->bill_amount = $collection['bill_amount'];
        $contract->client_id = $collection['client_id'];
        $contract->agency_id = $collection['agency_id'];
        $contract->save();
    }

    public function DeleteContract($id)
    {$this->contract->find($id)->delete();
    }
}
