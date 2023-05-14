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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id");
            $table->foreign("patient_id")->references("national_code")->on("patients")->onUpdate("cascade")->onDelete("cascade");
            $table->unsignedBigInteger("prescription_id")->nullable();
            $table->foreign("prescription_id")->references("id")->on("prescriptions")->onUpdate("cascade")->onDelete("cascade");
            $table->string("title");
            $table->string("content")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
