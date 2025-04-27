<?php

namespace App\Events;

use App\Models\Item;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ItemUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function broadcastOn()
    {
        return new Channel('items');
    }

    public function broadcastAs()
    {
        return 'item.updated';
    }

    public function broadcastWith()
    {
        return [
            'item_id' => $this->item->id,
            'item_name' => $this->item->name,
        ];
    }
}
