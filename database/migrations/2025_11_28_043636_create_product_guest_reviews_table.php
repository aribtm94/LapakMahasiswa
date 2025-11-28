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
    public function up(): void
    {
        Schema::create('product_guest_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            $table->string('name');
            $table->string('email');
            $table->unsignedTinyInteger('rating');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_guest_reviews');
    }
};
