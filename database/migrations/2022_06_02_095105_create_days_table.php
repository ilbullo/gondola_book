<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\DayType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('stazio_id')->nullable();
            $table->date('date');
            $table->double('percent',5,2);
            $table->enum('type',[DayType::NOLO->value,DayType::CAVANA->value,DayType::TABELLA->value]);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
            $table->foreign('stazio_id')->references('id')->on('stazios')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('days');
    }
};
