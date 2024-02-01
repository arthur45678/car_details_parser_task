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
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->string('title',600);
            $table->string('market')->nullable();
            $table->string('period')->nullable();
            $table->string('img_path')->nullable();
            $table->string('uri')->nullable();
            $table->unsignedBigInteger('carmodel_id');

            $table->foreign('carmodel_id')->references('id')->on('car_models')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generations');
    }
};
