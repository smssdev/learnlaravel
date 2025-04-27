<?php

namespace App\Http\Controllers;

use App\Events\TableUpdatedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        $tables = Cache::remember('tables', now()->addMinutes(10), function () {
            return Table::all();
        });

        return response()->json($tables);
    }

    public function updateStatus(Request $request, Table $table)
    {
        $request->validate([
            'status' => 'required|in:available,reserved,occupied',
        ]);

        $table->update(['status' => $request->status]);

        Cache::forget('tables');
        event(new TableUpdatedEvent($table));

        return response()->json($table);
    }



}
