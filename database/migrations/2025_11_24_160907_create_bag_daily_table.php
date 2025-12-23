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
    Schema::create('bag_daily', function (Blueprint $table) {
        $table->id();

        $table->string('code_voucher')->nullable();
        $table->date('sppd_date')->nullable();
        $table->string('sppd_reg_number')->nullable();
        $table->string('user')->nullable();
        $table->string('nip')->nullable();
        $table->string('status')->nullable();
        $table->string('tipe')->nullable();
        $table->text('deskripsi')->nullable();

        $table->decimal('biaya', 18, 2)->nullable();
        $table->decimal('service_fee', 18, 2)->nullable();
        $table->decimal('vat', 18, 2)->nullable();
        $table->decimal('total_final', 18, 2)->nullable();
        $table->decimal('refund', 18, 2)->nullable();

        $table->string('kode_booking')->nullable();
        $table->date('booking_date')->nullable();
        $table->date('issued_date')->nullable();
        $table->string('sla')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('bag_daily');
}

};
