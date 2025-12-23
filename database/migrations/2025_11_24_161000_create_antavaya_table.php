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
        Schema::create('antavaya', function (Blueprint $table) {
            $table->id();
    
            $table->date('invoice_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('traveler_name')->nullable();
            $table->string('voucher_no')->nullable();
            $table->text('description')->nullable();
            $table->string('airline_name')->nullable();
            $table->string('class')->nullable();
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('currency_name')->nullable();
    
            $table->decimal('total_fare', 18, 2)->nullable();
            $table->decimal('travel_service', 18, 2)->nullable();
            $table->decimal('vat', 18, 2)->nullable();
            $table->decimal('total_amount', 18, 2)->nullable();
    
            $table->string('remark_1')->nullable();
            $table->string('tipe')->nullable();
    
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('antavaya');
    }
};
