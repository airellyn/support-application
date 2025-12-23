<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_rekonsiliasis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_ba_pertama');
            $table->string('nomor_ba_kedua')->nullable();
            $table->date('periode_start');
            $table->date('periode_end');
            $table->decimal('total_pesawat', 15, 2)->default(0);
            $table->decimal('total_hotel', 15, 2)->default(0);
            $table->decimal('total_kereta', 15, 2)->default(0);
            $table->decimal('management_fee_percent', 5, 2)->default(3.5);
            $table->decimal('management_fee_value', 15, 2)->default(0);
            $table->decimal('vat_percent', 5, 2)->default(12);
            $table->decimal('vat_value', 15, 2)->default(0);
            $table->decimal('grand_total_exc_vat', 15, 2)->default(0);
            $table->decimal('grand_total_inc_vat', 15, 2)->default(0);
            $table->date('tanggal_ba');
            $table->string('status')->default('draft');
            $table->json('data_summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_rekonsiliasis');
    }
};