<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\Reservation;
use Cookie;
class ReservationRepository
{  private $invoice;
    private $reservation;
    private $announcement;

    public function __construct(Reservation $reservation,InvoiceRepository $invoice,AnnouncementRepository $announcement)
    {
        $this->reservation = $reservation;
        $this->invoice=$invoice;
        $this->announcement=$announcement;
    }


    public function getAllReservations()
    {
        return $this->reservation->all();
    }
    public function getReservationByClient(){
        $reservations=$this->reservation->where('client_id','=',json_decode(Cookie::get('client'))->id)->get();
        return $reservations;
}
    public function getReservationByCorporate(){
       if($this->reservation->join('announcements','reservations.announcement_id','=','announcements.id')
           ->where('announcements.corporate_id','=',auth('corporate')->user()->id)==null)
           return [];
       else
      return  $this->reservation->join('announcements','reservations.announcement_id','=','announcements.id')
            ->where('announcements.corporate_id','=',auth('corporate')->user()->id)
            ->select('reservations.*')->get();
    }
    public function getReservationById($id)
    {
        return $this->reservation->find($id);

    }



    public function acceptReservation($id)
    {  $reservation=$this->getReservationById($id);
        $reservation->state = Reservation::STATE['accepted'];
        $reservation->save();
        $announcement_id=$reservation->announcement_id;
        $reservations=$this->reservation->where('announcement_id','=',$announcement_id)->get();
        foreach ($reservations as $reservation){
            if($reservation->id!=$id)
            $this->refuseReservation($reservation->id);
        }

    }
    public function refuseReservation($id)
    {
        $reservation=$this->getReservationById($id);
        $reservation->state = Reservation::STATE['rejected'];
        $reservation->save();

    }

    public function DeleteRequestReservationAccount($id)
    {
        $this->requestreservation->find($id)->delete();

    }
}
