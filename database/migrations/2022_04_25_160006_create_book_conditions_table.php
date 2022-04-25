<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_item_id')->constrained()->cascadeOnUpdate();
            $table->unsignedTinyInteger('scale')->default(5)->comment('0: severe damage, 5: best');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_conditions');
    }
};
