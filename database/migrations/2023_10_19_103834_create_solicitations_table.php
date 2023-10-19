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
        Schema::create('solicitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');// FK Usuário
            $table->string('description');
            $table->string('quantity');
            $table->decimal('price', $precision = 15, $scale = 2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');// FK Usuário

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitations');
    }
};
