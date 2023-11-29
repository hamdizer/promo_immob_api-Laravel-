<?php

namespace App\Http\Controllers;

use App\Repositories\ContractRepository;
use App\Models\Reservation;
use App\Repositories\AnnouncementRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ReservationRepository;
use \Illuminate\Http\Request;

class ReservationController extends Controller
{private $invoice;
private $reservation;
private $announcement;
    public function __construct(ReservationRepository $reservation,AnnouncementRepository $announcement,InvoiceRepository $invoice){
        $this->reservation=$reservation;
        $this->announcement=$announcement;
        $this->invoice=$invoice;
    }
    public function getAllReservation(){
        return $this->reservation->getAllReservations();
    }
public function getReservationByClient(){
        return $this->reservation->getReservationByClient();
}
    public function getReservationByCorporate(){
        return $this->reservation->getReservationByCorporate();
    }
    public function acceptReservation($id,Request $request){
        $reservation=$this->reservation->getReservationById($id);
        $announcement=$this->announcement->getAnnouncementsById($reservation->announcement_id);
        if ($announcement->corporate_id == auth('corporate')->user()->id) {
            if ($reservation->state = Reservation::STATE['waiting']) {
                $this->reservation->acceptReservation($id);
                $inputsinvoice=[
                    'name'=>$request->input('name'),
                    'limit_date'=>$request->input('limit_date'),
                    'bill_amount'=>$request->input('bill_amount'),
                    'client_id'=>$reservation->client_id,
                ];
             $this->invoice->createInvoice($inputsinvoice);
               return response()->json(['success' => 'Reservation  accepted'],200);
            } else
                return ['error' => 'reservation already reserved'];
        } else return response()->json(['error' => 'unable to accept reservation,Announcement is not yours'],401);
    }

    public function rejectReservation($id){
        $reservation=$this->reservation->getReservationById($id);
        $announcement=$this->announcement->getAnnouncementsById($reservation->announcement_id);
        if ($announcement->corporate_id == auth('corporate')->user()->id) {
            if ($reservation->state = Reservation::STATE['waiting']) {
                $this->reservation->refuseReservation($id);
                $announcement->reserved=0;
                $announcement->save();
                response()->json(['success' => 'announcement  rejected'],200);
            } else
                return response()->json(['error' => 'announcement already rejected']);
        } else return response()->json(['error' => 'unable to reject announcement,Announcement is not yours'],401);
    }

}
