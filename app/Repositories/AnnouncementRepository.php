<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\Reservation;
use Cookie;
class AnnouncementRepository
{  private $announcement;
    public function __construct(Announcement $announcement ){
        $this->announcement=$announcement;
    }
    public function getAllAnnouncements()
    {
        return $this->announcement->all();
    }
    public function getAnnouncementsById($id)
    {
        return $this->announcement->find($id);
    }
    public function createannouncement($collection=[])
    {$announcement = new Announcement();
        $announcement->title = $collection['title'];
        $announcement->image = $collection['image'];
        $announcement->reserved = 0;
        $announcement->body = $collection['body'];
        $announcement->Corporates()->associate(auth('corporate')->user()->id);
        $announcement->save();
        // $announcement->Clients()->attach($clients);
    }
    public function updateAnnouncement($id,$collection=[])
    {
        $announcement =$this->announcement->find($id);
        if($collection['title']) {
            $announcement->title = $collection['title'];
        }
        if($collection['image']) {
            $announcement->image = $collection['image'];
        }
        if($collection['body']) {
            $announcement->body = $collection['body'];
        }

        $announcement->save();
    }
    public function DeleteAnnouncement($id)
    {$announcement=$this->announcement->find($id);
        /*foreach ($announcement->Clients as $client) {
            $announcement->Clients()->detach($client);
     }*/
        $announcement->delete();
    }
    public function reserveAnnouncement($id){
        $announcement=$this->getAnnouncementsById($id);
            $announcement->reserved = 1;
            $announcement->Clients()->attach(json_decode(Cookie::get('client'))->id,array('date'=>date('Y-m-d'),
                'state'=>Reservation::STATE['waiting']));

            $announcement->save();
    }

}
