<?php
namespace App\Http\Controllers;

use App\Repositories\AgencyRepository;
use App\Http\Requests\AgencyRequest;
class AgencyController extends Controller
{
    public $agency;

    public function __construct(AgencyRepository $agency)
    {
        $this->agency = $agency;
    }
    public function index(){
        $agencies=$this->agency->getAllAgencies();
        return $agencies;
    }
    public function store(AgencyRequest $request){
        $name = $request->input('name');
        $localization = $request->input('localization');



        $this->agency->createAgency(['name'=>$name,
            'localization'=>$localization,
        ]);

        return ['success'=>'Agency Created Successfully'];


    }
    public function show($id){
        $this->agency->getAgencyById($id);

    }

    public function update($id,AgencyRequest $request){
        $name = $request->input('name');
        $localization = $request->input('localization');
        $inputs=[
            'name'=>$name,
            'localization'=>$localization,
        ];
        $this->agency->UpdateAgency($id,$inputs);
        return ['success'=>'Agency Updated Successfully'];


    }
    public function destroy($id){
        $this->agency->DeleteAgency($id);
        return ['success'=>'Agency Deleted Successfully'];



    }
}

