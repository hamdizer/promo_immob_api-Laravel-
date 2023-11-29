<?php
namespace App\Http\Controllers;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Agency;
use App\Repositories\ClientRepository;


class ClientController extends Controller
{   private $client;
public function __construct(ClientRepository $client){
$this->client=$client;

}

/**
* @throws \Psr\Container\NotFoundExceptionInterface
* @throws \Psr\Container\ContainerExceptionInterface
*/
public function register(ClientRequest $request)
{ $cin=$request->input('cin');
$first_name=$request->input('first_name');
$last_name=$request->input('last_name');
$email=$request->input('email');
$password=$request->input('password');
$phone_number=$request->input('phone_number');
$address=$request->input('address');

$inputs=[
'cin'=>$cin,
'first_name'=>$first_name,
'last_name'=>$last_name,
'email'=>$email,
'password'=>$password,
'phone_number'=>$phone_number,
'address'=>$address
];
if(UtilsController::checkExistanceCin($cin,'corporates','administrators')){
$this->client->register($request->validated());
return response()->json(['success'=>'Client Successfully registered ',$inputs]);
}
else{
    return response()->json(['error'=>'cin already exists']);

}
}


public  function show($id){
$client=$this->client->find($id);
return $client;
}
public function login(LoginRequest $request){
$input=['email'=>$request->get('email'),'password'=>$request->get('password')];
return  $this->client->login($input);

}
public function logout( ){
return  $this->client->logout();

}
public function me(){
return $this->client->me();

}

public function refresh()
{
$this->client->refresh();
}
public function respondWithToken($token)
{
$this->client->respondWithToken($token);
}

public function getAllClient(){
    return $this->client->getAllClients();
}
public function getClientsByCorporate(){
    return $this->client->getClientByCorporate();
}
public function choiceAgency($id){
    if(Agency::find($id)==null)
        return response()->json(['error'=>'agency not exist'],404);
    else {
        $this->client->ChoiceAgency($id);
        return response()->json(['success'=>'agency affected'],200);

    }
}
}
