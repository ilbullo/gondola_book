<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\WorkType;
use App\Enum\PaymentType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_id');
            $table->enum('type',[ WorkType::AGENZIA->value, WorkType::CAVANA->value, WorkType::NOLO->value ]);
            $table->foreignId('agency_id');
            $table->double('amount','6,2');
            $table->dateTime('payment_date');
            $table->enum('payment_type',[ PaymentType::CASH->value, PaymentType::INVOICE->value, PaymentType::POS->value ]);
            $table->text('note');
            $table->foreign('day_id')->references('id')->on('days')->cascadeOnUpdate();
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
        Schema::dropIfExists('dayrows');
    }
};
