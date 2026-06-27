<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->decimal('height', 5, 2)->nullable()->comment('in cm');
            $table->decimal('weight', 5, 2)->nullable()->comment('in kg');
            $table->string('blood_group', 5)->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('caste', 100)->nullable();
            $table->string('mother_tongue', 100)->nullable();
            $table->string('nationality', 100)->default('Bangladeshi');
            $table->string('country', 100)->nullable();
            $table->string('division', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->text('address')->nullable();
            $table->enum('marital_status', ['never_married', 'divorced', 'widowed', 'separated'])->default('never_married');
            $table->boolean('have_children')->default(false);
            $table->integer('no_of_children')->default(0);
            $table->string('occupation', 100)->nullable();
            $table->string('organization', 150)->nullable();
            $table->string('annual_income', 100)->nullable();
            $table->string('education_level', 100)->nullable();
            $table->string('university', 150)->nullable();
            $table->text('about_me')->nullable();
            $table->enum('profile_created_by', ['self', 'parent', 'sibling', 'friend'])->default('self');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('completeness')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
