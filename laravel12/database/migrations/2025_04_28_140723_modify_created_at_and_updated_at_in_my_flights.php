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
            $table->integer('created_at')->nullable()->change();  // تعديل نوع العمود إلى DATETIME
            $table->integer('updated_at')->nullable()->change();  // تعديل نوع العمود إلى DATETIME
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('my_flights', function (Blueprint $table) {
            $table->integer('created_at')->nullable()->change();  // تعديل نوع العمود إلى DATETIME
            $table->integer('updated_at')->nullable()->change();  // تعديل نوع العمود إلى DATETIME
        });
    }
};
