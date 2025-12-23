<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grab_bag', function (Blueprint $table) {
            $table->id();

            $table->timestamp('transaction_time')->nullable();
            $table->string('company_name')->nullable();
            $table->string('portal_id')->nullable();

            $table->string('employee_name')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('group_name')->nullable();

            $table->string('booking_code')->nullable();
            $table->string('vertical')->nullable();
            $table->string('service_type')->nullable();
            $table->string('source')->nullable();

            $table->string('trip_code')->nullable();
            $table->string('trip_description')->nullable();

            $table->string('city')->nullable();
            $table->text('pick_up_address')->nullable();
            $table->text('intermediate_dropoff')->nullable();
            $table->text('drop_off_address')->nullable();

            $table->decimal('distance_in_km', 10, 2)->nullable();

            $table->timestamp('creation_time')->nullable();
            $table->timestamp('completion_time')->nullable();

            $table->decimal('amount', 15, 2)->nullable();
            $table->string('currency', 10)->nullable();

            $table->string('payment_method')->nullable();
            $table->string('billing_type')->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('event_name')->nullable();

            $table->timestamps();

            // Optional index (recommended)
            $table->index('booking_code');
            $table->index('transaction_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grab_bag');
    }
};
