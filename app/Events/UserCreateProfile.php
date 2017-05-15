<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCreateProfile implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->data = [
            'user_name' => "{$profile->first_name} {$profile->last_name}",
            'url' => route('user.profile.detail' , $profile->id),
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('updated-profile');
        //return new PrivateChannel('updated-profile');
        return [
            "notify"
        ];

    }







}
