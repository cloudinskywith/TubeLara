<?php

namespace App\Http\Controllers;

use App\Http\Models\Channel;
use Illuminate\Http\Request;

class ChannelSettingsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(Channel $channel)
    {
        return view('channel.edit',compact('channel'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
