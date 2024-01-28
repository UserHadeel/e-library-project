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
        Schema::create('graduation_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name');
            $table->string('supervisor_name');
            $table->string('year');
            $table->string('dep_name');
            $table->foreign('dep_name')->references('name')
                    ->on('departments')
                    ->onDelete('CASCADE');
            $table->mediumText('image')->nullable();
            $table->mediumText('resource')->nullable();
            $table->unsignedInteger('available_quantity');
            $table->boolean('able_to_borrow')->default(true)->nullable();
            $table->boolean('able_to_download')->default(true)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_projects');
    }
};
