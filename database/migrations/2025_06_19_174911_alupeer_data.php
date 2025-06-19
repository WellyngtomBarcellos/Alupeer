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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('item_id');
            $table->BigInteger('user_id');
            $table->BigInteger('parent_id');
            $table->string('content');
            $table->timestamps();
        });

        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('user_id');
            $table->bigInteger('owner');
            $table->timestamp('date');
            $table->integer('review');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name_item');
            $table->bigInteger('owner');
            $table->integer('price');
            $table->string('category');
            $table->string('descricao');
            $table->string('float');
            $table->integer('reservado');
            $table->integer('long');
            $table->integer('lat');
            $table->integer('token');
            $table->timestamps();
        });

        Schema::create('item_review', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->bigInteger('user_id');
            $table->Integer('star');
            $table->string('content');
            $table->timestamps();
        });
        Schema::create('image_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_id');
            $table->string('link');
            $table->timestamps();
        });
        Schema::create('Product', function (Blueprint $table) {
            $table->id();
            $table->json('item');
            $table->bigInteger('owner');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
