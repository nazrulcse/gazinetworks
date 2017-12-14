<?php

namespace App\Http\Controllers\API\v1;

use App\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $announcements = Announcement::where('publish_date', '<=', $today)->where('expire_date', '>=', $today)->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 200, 'response' => $announcements]);
    }
}
