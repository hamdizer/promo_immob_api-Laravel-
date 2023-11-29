<?php

namespace App\Repositories;
use App\Models\Agency;
use App\Models\Corporate;

class AgencyRepository
{
    private $agency;

    public function __construct(Agency $agency)
    {
        $this->agency = $agency;
    }

    public function getAllAgencies()
    {
        return $this->agency->all();
    }

    public function getAgencyById($id)
    {
        return $this->agency->find($id);
    }

    public function createAgency($collection = [])
    {   //$collection=request()->except(['_token','_method']);
        $agency = new Agency();
        $agency->name = $collection['name'];
        $agency->localization = $collection['localization'];
        $agency->save();
    }

    public function UpdateAgency($id, $collection = [])
    {
        $agency = $this->agency->find($id);
        if ($collection['name']) {
            $agency->name = $collection['name'];
        }
        if ($collection['localization']) {

            $agency->localization = $collection['localization'];
        }
        $agency->save();

    }

    public function DeleteAgency($id)
    {
        $agency = $this->agency->find($id);
       // $agency->Corporates()->delete();


        $agency->delete();

    }
}
