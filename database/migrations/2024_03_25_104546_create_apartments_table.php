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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('slug');
            $table->unsignedTinyInteger('n_rooms')->default(1);
            $table->unsignedTinyInteger('n_beds')->default(1);
            $table->unsignedTinyInteger('n_baths')->default(1);
            $table->unsignedSmallinteger('mq');
            $table->float('price')->unsigned();
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->mediumText('lat')->decimal();
            $table->mediumText('lon')->decimal();
            $table->string('cover_img', 1024);
            $table->boolean('visible')->default(true);
            $table->timestamps();
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
