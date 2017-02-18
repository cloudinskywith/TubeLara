<?php

namespace App\Jobs;

use App\Http\Models\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Intervention\Image\Facades\Image;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $channel;
    public $fileId;

    public function __construct(Channel $channel,$fileId)
    {
        $this->channel = $channel;
        $this->fileId = $fileId;
    }

    public function handle()
    {
        $path = storage_path() . '/uploads/' . $this->fileId;
        $fileName = $this->fileId . '.png';

//        File::delete($path);
//        Image::make($path)->resize(40,40);
//        Image::make($path)->encode('png')->fit(40,40,function($c){
//            $c->upsize();
//        });
        // todo resize image
        $this->channel->image_filename = $fileName;
        $this->channel->save();
    }
}
