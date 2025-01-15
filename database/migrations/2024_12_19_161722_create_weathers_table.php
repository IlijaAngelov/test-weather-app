<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();

            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->string('description');
            $table->decimal('temperature');
            $table->string('country');
            $table->string('city');

            $table->string('timezone');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
