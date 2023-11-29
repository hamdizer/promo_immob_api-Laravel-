<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Client;
use App\Http\Middleware\Corporate;
use App\Models\Administrator;
use App\Repositories\AdministratorRepository;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
class AdministratorController extends Controller
{   private $admin;
    public function __construct(AdministratorRepository $admin){
        $this->admin=$admin;
    }

    /**
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register(AdminRequest $request)
    {  $cin=$request->input('cin');
        $first_name=$request->input('first_name');
        $last_name=$request->input('last_name');
        $email=$request->input('email');
        $password=$request->input('password');
        $inputs=[
            'cin'=>$cin,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>$password
        ];
        if(UtilsController::checkExistanceCin($cin,'corporates','clients')) {
            $this->admin->register($request->validated());
            return response()->json(['success' => 'Administrator Successfully registered ', $inputs]);
        }
        else{
            return response()->json(['error'=>'cin already exists']);
    }
    }
    public function registerSuperAdmin(AdminRequest $request)
    {  $cin=$request->input('cin');
        $first_name=$request->input('first_name');
        $last_name=$request->input('last_name');
        $email=$request->input('email');
        $password=$request->input('password');
        $inputs=[
            'cin'=>$cin,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>$password
        ];
      if(UtilsController::checkExistanceCin($cin,'corporates','clients')){
            $this->admin->registerSuperAdmin($request->validated());
            return response()->json(['success' => 'SuperAdmin Successfully registered ', $inputs]);
        }
        else
            return response()->json(['error'=>'cin already exists']);
    }

    public function login(LoginRequest $request){
     $inputs=['email'=>$request->input('email'),'password'=>$request->input('password')];
     return $this->admin->login($inputs);
    }
    public function me()
    {
        return response()->json(auth('admin')->user());
    }
    public function logout()
    {
        return $this->admin->logout();

    }
    public function Update($id,AdminRequest $request){
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
        $this->admin->UpdateAdmin($id,$inputs);
        return ['success'=>'Admin Successfully Updated'];
    }
    public function respondWithToken($token)
    {
        $this->admin->respondWithToken($token);

    }
    public function DeleteAdmin($id){
        $this->admin->DeleteAdmin($id);
        return ['success'=>'Admin Successfully Deleted'];
    }

}
