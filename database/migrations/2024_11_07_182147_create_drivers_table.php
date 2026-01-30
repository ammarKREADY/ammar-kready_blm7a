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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities");
            $table->time("start_jop");
            $table->time("end_jop");
            $table->enum("vehicle",array("car","motor","bicycle"));
            $table->integer("driver_cost")->default(1000);
            $table->integer("salary");
            $table->enum("status",array("pindding","on_way"))->default("pindding");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
