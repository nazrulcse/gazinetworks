<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::orderBy('id', 'DESC')->get();
        return view('announcements.index')->with('announcements', $announcements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'expire_date' => 'required',
            'publish_date' => 'required'
        ])->validate();

        $input = $request->all();
        $announcement = Announcement::create($input);
        if($announcement) {
            return Redirect::to('announcements');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\announcement  $announcements
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
       $announcement = Announcement::find($announcement->id);
       return view('announcements.edit')->with('announcement', $announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $announcement = Announcement::find($announcement->id);
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'expire_date' => 'required',
            'publish_date' => 'required'
        ])->validate();

        if($announcement->fill($input)->save()) {
           return Redirect::to('announcements');
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
       $announcement = Announcement::find($announcement->id);
       $announcement->delete();
       return Redirect::to('announcements');
    }
}
