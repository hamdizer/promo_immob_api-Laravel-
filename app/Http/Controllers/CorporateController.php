<?php

namespace App\Http\Controllers;
use App\Repositories\CorporateRepository;
use App\Http\Requests\CorporateRequest;
use App\Models\Corporate;
use \App\Http\Requests\LoginRequest;
use phpDocumentor\Reflection\Types\This;


class CorporateController extends Controller
{
    private $corporate;
    public function __construct(CorporateRepository $corporate){
        $this->corporate=$corporate;

    }

    /**
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register(CorporateRequest $request){
        $cin=$request->input('cin');
        $first_name=$request->input('first_name');
        $last_name=$request->input('last_name');
        $email=$request->input('email');
        $password=$request->input('password');
        $inputs=[
            'cin'=>$cin,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>$password,
        ];
        if(UtilsController::checkExistanceCin($cin,'clients','administrators')) {
            $this->corporate->register($inputs);
            return response()->json(['success' => 'Corporate Successfully registered ', $inputs]);
        }
        else
            return response()->json(['error'=>'cin already exists']);

    }
    public function RegisterManager(CorporateRequest $request)
    {
        $cin = $request->input('cin');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $agency_id = $request->input('agency_id');

        $inputs = [
            'cin' => $cin,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'agency_id' => $agency_id
        ];
        if(UtilsController::checkExistanceCin($cin,'clients','administrators')) {

            $this->corporate->registerManager($inputs);
            return response()->json(['success' => 'Manager Successfully registered ', $inputs]);
        }
        else
            return response()->json(['error'=>'cin already exists']);

    }
    public  function show($id){
        $corporate=$this->corporate->find($id);
        return $corporate;
    }
    public function login(LoginRequest $request){
        $input=['email'=>$request->get('email'),'password'=>$request->get('password')];
        return  $this->corporate->login($input);


    }
    public function logout( ){
       return $this->corporate->logout();

    }
    public function me(){
        return $this->corporate->me();

    }
public function updateCorporate($id,CorporateRequest $request){
    $first_name=$request->input('first_name');
    $last_name=$request->input('last_name');
    $email=$request->input('email');
    $password=$request->input('password');
    $inputs=[
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=>$password
    ];
    $this->corporate->updateCorporate($id,$inputs);
    return ['success'=>'Corporate Successfully Updated'];
}

    public function refresh()
    {
        $this->corporate->refresh();
    }
    public function respondWithToken($token)
    {
        $this->corporate->respondWithToken($token);
    }
    public function deleteCorporate($id){
        $this->corporate->deleteCorporate($id);
        return ['success'=>'Corporate Successfully Deleted'];

    }


}
