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

        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('serial_number')->unique();
            $table->unsignedInteger('available_quantity');
            $table->text('description')->nullable();
            $table->string('cat_name');
            $table->foreign('cat_name')->references('name')
                    ->on('categories')
                    ->onDelete('CASCADE');
            $table->mediumText('image')->nullable();
            $table->mediumText('resource')->nullable();
            $table->boolean('able_to_borrow')->default(true)->nullable();
            $table->boolean('able_to_download')->default(true)->nullable();


            // $table->unsignedBigInteger('category_id')->nullable();

            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');


    }
};
