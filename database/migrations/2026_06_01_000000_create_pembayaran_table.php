<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_registration_id')->constrained('course_registrations')->cascadeOnDelete();

            $table->string('invoice_code')->index();
            $table->decimal('amount', 15, 2);
            $table->string('payment_method');

            $table->string('status', 30)->default('pending'); // pending|lunas|gagal
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

