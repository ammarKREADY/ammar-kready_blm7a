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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("driver_id");
            $table->unsignedBigInteger("restaurant_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("driver_id")->references("id")->on("drivers");
            $table->foreign("restaurant_id")->references("id")->on("restaurants");
            $table->string("address");
            $table->string("phone"); 
            $table->enum("status",array("pindding","on_way","comfirm","cancel"))->default("pindding");
            $table->integer("total_price");
            $table->integer("drive_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
