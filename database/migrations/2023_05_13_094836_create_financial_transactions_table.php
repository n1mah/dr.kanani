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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger("patient_id");
            $table->foreign("patient_id")->references("national_code")->on("patients")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("appointment_id")->nullable();
            $table->foreign("appointment_id")->references("id")->on("appointments");
            $table->string("method")->default("غیره");
            $table->integer("payment_amount");
            $table->string("comment")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
