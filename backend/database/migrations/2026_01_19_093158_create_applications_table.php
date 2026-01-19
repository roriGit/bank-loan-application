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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('users_id')->constrained('users');
            $table->string('loan_type')->nullable()->default('personal');
            $table->decimal('loan_amount', 15, 2);
            $table->integer('loan_term_months');
            $table->decimal('monthly_income', 15, 2)->nullable();
            $table->string('status')->default('pending')->collection(['pending', 'approved', 'rejected']);
            $table->text('notes')->nullable();
            $table->date('application_date')->nullable()->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
