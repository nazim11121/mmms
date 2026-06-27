<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->decimal('height_from', 5, 2)->nullable();
            $table->decimal('height_to', 5, 2)->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('caste', 100)->nullable();
            $table->string('marital_status', 50)->nullable();
            $table->string('education', 100)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('annual_income_from', 100)->nullable();
            $table->string('annual_income_to', 100)->nullable();
            $table->text('about_partner')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_preferences');
    }
};
