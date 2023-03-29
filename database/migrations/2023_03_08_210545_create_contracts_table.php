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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('proposal_id')->unique()->nullable()->constrained('proposals')->nullOnDelete();
            $table->date('start_on');
            $table->date('end_on');
            $table->date('completed_on')->nullable();
            $table->unsignedFloat('cost');
            $table->enum('type',['fixed','hourly']);
            $table->unsignedFloat('hours')->nullable()->default(0);//مدة فترة الزمنية
            $table->enum('status',['active','completed','terminated']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
