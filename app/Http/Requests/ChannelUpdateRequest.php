<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChannelUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $channelId = Auth::user()->channel()->first()->id;
        return [
            'name'=>'required|max:255|unique:channels,name,'.$channelId,
            'slug'=>'required|max:255|alpha_num|unique:channels,slug,'.$channelId,
            'description'=>'max:1000',
        ];
    }
}
