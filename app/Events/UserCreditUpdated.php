<?php


namespace App\Events;


use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserCreditUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;

    private $primaryCredit;

    private $updatedCredit;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, int $primaryCredit, int $updatedCredit)
    {
        Log::info("credit change event fired");
        $this->user = $user;
        $this->primaryCredit = $primaryCredit;
        $this->updatedCredit = $updatedCredit;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function getPrimaryCredit()
    {
        return $this->primaryCredit;
    }

    public function getUpdatedCredit()
    {
        return $this->updatedCredit;
    }
}