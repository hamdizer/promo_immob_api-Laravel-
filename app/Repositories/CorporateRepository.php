<?php

namespace App\Repositories;
use App\Models\Announcement;
use App\Models\Corporate;

class CorporateRepository
{ private $corporate;
  public function __construct(Corporate $corporate){
      $this->corporate=$corporate;
  }

    public function getAllCorporates()
    {
        return $this->corporate->all();


    }

    public function getCorporateById($id)
    {
        return $this->corporate->find($id);
    }

    public function register($collection = [])
    {
        $corporate = new Corporate();
        $corporate->cin = $collection['cin'];
        $corporate->last_name = $collection['last_name'];
        $corporate->first_name = $collection['first_name'];
        $corporate->email = $collection['email'];
        $corporate->password = bcrypt($collection['password']);
        $corporate->role = $this->corporate::Role['corporate'];
        $corporate->agency_id = auth('corporate')->user()->agency_id;
        $corporate->save();
    }
    public function registerManager($collection = [])
    {
        $corporate = new Corporate();
        $corporate->cin = $collection['cin'];
        $corporate->last_name = $collection['last_name'];
        $corporate->first_name = $collection['first_name'];
        $corporate->email = $collection['email'];
        $corporate->password = bcrypt($collection['password']);
        $corporate->role = $this->corporate::Role['manager'];
        $corporate->Agency()->associate(intval($collection['agency_id']));
        $corporate->save();
    }
    public function updateCorporate($id,$collection=[])
    {
        $corporate = $this->corporate->find($id);
        if($collection['last_name']) {
            $corporate->last_name = $collection['last_name'];
        }
        if($collection['first_name']) {
            $corporate->first_name = $collection['first_name'];
        }
        if($collection['email']) {
            $corporate->email = $collection['email'];
        }
        if($collection['password']) {
            $corporate->password = bcrypt($collection['password']);
        }
        $corporate->save();
    }

    public function deleteCorporate($id)
    {$corporate=$this->corporate->find($id);
        /*foreach ($corporate->Announcements as $announcement)
            $announcement->delete();*/

        $corporate->delete();

    }

    public function login($collection = [])
    {
        if ($token = auth('corporate')->attempt($collection)) {
            return $this->respondWithToken($token);

        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        auth('corporate')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return auth('corporate')->user();
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60
        ]);
    }


}
