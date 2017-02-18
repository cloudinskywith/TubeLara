<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(Request $request){
        // generate uid
        // grab user channel
        // store the data
        $uid = uniqid(true);
        $channel = $request->user()->channel()->first();
        $video = $channel->videos()->create([
            'uid'=>$uid,
            'title'=>$request->title,
            'description'=>$request->description,
            'visibility'=>$request->visibility,
            'video_filename'=>"{$uid}.{$request->extension}",
        ]);
        return response()->json([
            'data'=>[
                'uid'=>$uid,
            ]
        ]);
    }
}
