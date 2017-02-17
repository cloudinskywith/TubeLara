<?php

namespace App\Http\Controllers;

use App\Http\Models\Channel;
use App\Http\Requests\ChannelUpdateRequest;
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
        $this->authorize('edit',$channel);
        return view('channel.edit',compact('channel'));
    }

    public function update(ChannelUpdateRequest $request,Channel $channel)
    {
        $this->authorize('update',$channel);
        $channel->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'description'=>$request->description,
        ]);

        if($request->file('image')){
            //move to temp location
            $request->file('image')->move(storage_path().'/uploads',$fileId = uniqid(true));

        }
        return redirect()->to("/channel/{$channel->slug}/edit");
    }

    public function destroy($id)
    {
        //
    }
}
