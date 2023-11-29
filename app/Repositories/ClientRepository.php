<?php

namespace App\Repositories;

use App\Models\Agency;
use App\Models\Client;
use Hash;
use Illuminate\Support\Facades\Cookie;

class ClientRepository  {
    private $client;
 public function __construct(Client $client)
 {
     $this->client=$client;

 }

    public function getAllClients()
    {
        return $this->client->all();
    }

    public function getClientById($id)
    {
        return $this->client->find($id);
    }

    public function register($collection = [])
    {
        $client = new Client();
        $client->cin = $collection['cin'];
        $client->last_name = $collection['last_name'];
        $client->first_name = $collection['first_name'];
        $client->phone_number = $collection['phone_number'];
        $client->address = $collection['address'];
        $client->email = $collection['email'];
        $client->password =bcrypt($collection['password']);
        $client->save();
    }

    public function UpdateClient($id,$collection=[])
    {
        $client = $this->client->find($id);
        $client->cin = $collection['cin'];
        $client->last_name = $collection['last_name'];
        $client->first_name = $collection['first_name'];
        $client->phone_number = $collection['phone_number'];
        $client->address = $collection['address'];
        $client->email = $collection['email'];
        $client->password = $collection['password'];
        $client->save();
    }

    public function DeleteClient($id)
    {
       $this->client->find($id)->delete();
    }
    public function login($collection=[]){
     $user=$this->client->where('email','=',$collection['email'])->first();
       if(!Hash::check($collection['password'],$user->password)){

            return response()->json(['error' => 'Unauthorized'], 401);


           }
        if ($token =auth('customer')->login($user)){
            return $this->respondWithToken($token)->withCookie(cookie('client',$user,360));
       }
        //if ($token =auth('customer')->attempt($collection)) {
            //$this->user=auth('customer')->user();
          // return $this->respondWithToken($token);

    //}
        return response()->json(['error' => 'Unauthorized'], 401);

    }
    public function logout(){
        auth('customer')->logout();
        return response()->json(['message'=>'Successfully logged out'])->withCookie(cookie('client',null,0));;
    }
    public function me(){
        auth('customer')->setUser(new Client(json_decode(Cookie::get('client'),true)));
        return  auth('customer')->user();

    }
    public function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=> 60
        ]);
    }
    public function ChoiceAgency($id){
     $client_id=json_decode(Cookie::get('client'))->id;
        $client=$this->getClientById($client_id);
        $client->agency_id=$id;
        $client->save();
    }
    public function getClientByCorporate(){
     $agency_id=auth('corporate')->user()->agency_id;
        $clients= $this->client->find($agency_id);
        return $clients;
    }

}

