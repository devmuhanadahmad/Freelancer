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
        Schema::create('profiles', function (Blueprint $table) {
            /*
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');

            $table->unsignedFloat('houriy_rate')->default(0);
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('account_type', ['entrepreneur', 'freelancer'])->default('Freelancer');
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->char('country', 2);
            $table->char('locale', 2)->default('en');
            $table->string('image')->nullable();
            $table->string('verified')->default(0);

            $table->timestamps();

            $table->primary('user_id');
             */
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->char('country', 2);
            $table->char('locale')->default('en');

            $table->string('job_name');
            $table->string('specialization');
            $table->text('description')->nullable();
            $table->unsignedFloat('houriy_rate')->default(0);
            $table->enum('account_type', ['entrepreneur', 'freelancer'])->default('Freelancer');
            $table->string('image')->nullable();
            $table->string('verified')->default(0);

            $table->timestamps();
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
