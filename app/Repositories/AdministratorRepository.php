<?php

namespace App\Repositories;

use App\Models\Administrator;


class AdministratorRepository{
    private $admin;
    public function __construct(Administrator $admin){
        $this->admin=$admin;
    }

    public function getAllAdmins()
    {
        return $this->admin->all();
    }

    public function getAdminById($id)
    {
        return $this->admin->find($id);
    }

    public function register($collection = [])
    {
        $administrator = new Administrator();
        $administrator->cin = $collection['cin'];
        $administrator->last_name = $collection['last_name'];
        $administrator->first_name = $collection['first_name'];
        $administrator->email = $collection['email'];
        $administrator->password =bcrypt($collection['password']);
        $administrator->role = $this->admin::Role['Admin'];

        $administrator->save();    }
    public function registerSuperAdmin($collection = [])
    {
        $administrator = new Administrator();
        $administrator->cin = $collection['cin'];
        $administrator->last_name = $collection['last_name'];
        $administrator->first_name = $collection['first_name'];
        $administrator->email = $collection['email'];
        $administrator->password =bcrypt($collection['password']);
        $administrator->role = $this->admin::Role['Super-Admin'];
        $administrator->save();    }

    public function UpdateAdmin($id,$collection=[])
    {    $administrator=$this->admin->find($id);
        if( $collection['last_name']) {
            $administrator->last_name = $collection['last_name'];
        }
        if($collection['first_name']) {
            $administrator->first_name = $collection['first_name'];
        }
       if($collection['email']) {
           $administrator->email = $collection['email'];
       }
       if($collection['password']) {
           $administrator->password = $collection['password'];
       }
       if(!$collection['last_name']&&!$collection['first_name']&&!$collection['email']&&!$collection['password'])
           return ['error'=>'error'];
       else
         $administrator->save();
    }

    public function DeleteAdmin($id)
    {
        $this->admin->find($id)->delete();
    }

    public function login($collection=[])
    {
        //dd($collection);
        if ($token =auth('admin')->attempt($collection)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        auth('admin')->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }

    public function me()
    {
        return auth('admin')->user();    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=> 60
        ]);

    }


}
{

}
