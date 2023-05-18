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
        Schema::create('patients', function (Blueprint $table) {
            $table->id("national_code");
            $table->string("firstname");
            $table->string("lastname");
            $table->integer("day")->length(2);
            $table->integer("month")->length(2);
            $table->integer("year")->length(4);;
            $table->unsignedBigInteger("insurance_id");
            $table->foreign("insurance_id")->references("id")->on("insurances")->onUpdate("cascade")->onDelete("cascade");
            $table->string("mobile");
            $table->string("phone")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
