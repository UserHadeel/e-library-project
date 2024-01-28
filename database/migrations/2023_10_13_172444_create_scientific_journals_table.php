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
        Schema::create('scientific_journals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('publishing');
            $table->string('Year_of_publication');
            $table->mediumText('image')->nullable();
            $table->mediumText('resource')->nullable();
            $table->boolean('able_to_download')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scientific_journals');
    }
};
