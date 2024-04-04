<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

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
            $table->decimal('price', 5, 2)->unsigned();
            $table->string('address');
            // $table->string('city');
            // $table->string('zip_code');
            $table->decimal('lat',10,7)->default(44.8795);
            $table->decimal('lon', 10,7)->default(21.8795);
            $table->string('cover_img', 1024);
            $table->boolean('visible')->default(true);
            $table->softDeletes();
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
