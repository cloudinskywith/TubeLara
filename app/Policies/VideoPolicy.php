<?php

namespace App\Policies;

use App\Http\Models\Video;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function update(User $user,Video $video){
        return $user->id === $video->channel->user_id;
    }
}
