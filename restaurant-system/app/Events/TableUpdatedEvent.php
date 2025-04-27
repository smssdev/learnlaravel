<?php

namespace App\Events;

use App\Models\Table;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function broadcastOn()
    {
        return new Channel('tables');
    }

    public function broadcastAs()
    {
        return 'table.updated';
    }

    public function broadcastWith()
    {
        return [
            'table_id' => $this->table->id,
            'table_number' => $this->table->number,
            'status' => $this->table->status,
        ];
    }
}
