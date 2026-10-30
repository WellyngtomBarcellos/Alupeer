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
        Schema::table('items', function (Blueprint $table) {
            $table->integer('reservado')->default(0)->change();
            $table->string('token', 64)->change();
            $table->decimal('lat', 10, 7)->change();
            $table->decimal('long', 10, 7)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('reservado')->default(null)->change();
            $table->string('token', 64)->change();
            $table->decimal('lat', 10, 7)->change();
            $table->decimal('long', 10, 7)->change();
        });
    }
};
