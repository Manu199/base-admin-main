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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->integer('price')->unsigned();
            $table->integer('square_meters')->unsigned();
            $table->integer('num_of_room')->unsigned();
            $table->integer('num_of_bed')->unsigned();
            $table->integer('num_of_bathroom')->unsigned();
            $table->string('country');
            $table->string('street_address');
            $table->string('city_name');
            $table->string('postal_code');
            $table->decimal('lat', 7, 5);
            $table->decimal('lon', 8, 5);
            $table->text('image_path');
            $table->boolean('visible')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
