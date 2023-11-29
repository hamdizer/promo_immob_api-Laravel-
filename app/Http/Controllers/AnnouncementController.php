<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use App\Http\Requests\AnnouncementRequest;
use App\Repositories\ClientRepository;
use App\Repositories\CorporateRepository;
use Cookie;
class AnnouncementController extends Controller
{
    private $corporate;
    private $announcement;
    private $client;

    public function __construct(AnnouncementRepository $announcement, CorporateRepository $corporate, ClientRepository $client)
    {
        $this->announcement = $announcement;
        $this->corporate = $corporate;
        $this->client = $client;
    }

    public function index()
    {
        return $this->announcement->getAllAnnouncements();
    }

    public function store(AnnouncementRequest $request)
    {
        $title = $request->input('title');
        $image = $request->file('image');
        $name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
        $location = 'images/announcements/';
        $path = $location . $name;
        $image->move($location, $name);
        $body = $request->input('body');
        $inputs = ['title' => $title,
            'image' => $path,
            'body' => $body
        ];
        $this->announcement->createAnnouncement($inputs);
        return ['success' => 'Announcement Created Successfully'];


    }

    public function updateAnnouncement($id, AnnouncementRequest $request)
    {
        $title = $request->input('title');
        $image = $request->file('image');
        $name = hexdec(uniqid()) . '.' . strtolower($image->getClientOriginalExtension());
        $location = 'images/announcements/';
        $path = $location . $name;
        $oldimage = Announcement::find($id)->value('image');
        unlink($oldimage);
        $oldimage = $path;
        $body = $request->input('body');
        $image->move($location, $name);

        $inputs = ['title' => $title,
            'image' => $path,
            'body' => $body
        ];
        $this->announcement->updateAnnouncement($id, $inputs);
        return ['success' => 'Announcement Updated Successfully'];

    }

    public function destroy($id)
    {
        $this->announcement->DeleteAnnouncement($id);
        return ['success' => 'Announcement Deleted Successfully'];


    }

    public function reserveAnnouncement($id)
    {
        $announcement = $this->announcement->getAnnouncementsById($id);
        $corporate= $this->corporate->getCorporateById($announcement->corporate_id);
        $agency_id=$corporate->agency_id;
        $client_agency_id = $this->client->getClientById(json_decode(Cookie::get('client'))->id)->agency_id;
        if ($agency_id == $client_agency_id) {
            $this->announcement->reserveAnnouncement($id);
            return response()->json(['success' => 'Announcement Reserved Successfully'], 200);

        } else return
            response()->json(['error' => 'Your are not our client'], 401);

    }
}
