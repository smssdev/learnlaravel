<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('my_flights', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('updated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('my_flights', function (Blueprint $table) {
            $table->dropColumn('creation_date');
            $table->dropColumn('updated_date');
            $table->timestamps(); // ترجع created_at و updated_at
        });
    }
};
