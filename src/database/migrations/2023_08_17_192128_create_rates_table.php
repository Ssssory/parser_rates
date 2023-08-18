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
        Schema::create('rates', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->date('history_date')->index('rate_date');
            $table->decimal('RUR', 10, 4)->default(1);
            $table->decimal('AUD', 10, 4)->nullable();
            $table->decimal('AZN', 10, 4)->nullable();
            $table->decimal('GBP', 10, 4)->nullable();
            $table->decimal('AMD', 10, 4)->nullable();
            $table->decimal('BYN', 10, 4)->nullable();
            $table->decimal('BGN', 10, 4)->nullable();
            $table->decimal('BRL', 10, 4)->nullable();
            $table->decimal('HUF', 10, 4)->nullable();
            $table->decimal('VND', 10, 4)->nullable();
            $table->decimal('HKD', 10, 4)->nullable();
            $table->decimal('GEL', 10, 4)->nullable();
            $table->decimal('DKK', 10, 4)->nullable();
            $table->decimal('AED', 10, 4)->nullable();
            $table->decimal('USD', 10, 4)->nullable();
            $table->decimal('EUR', 10, 4)->nullable();
            $table->decimal('EGP', 10, 4)->nullable();
            $table->decimal('INR', 10, 4)->nullable();
            $table->decimal('IDR', 10, 4)->nullable();
            $table->decimal('KZT', 10, 4)->nullable();
            $table->decimal('CAD', 10, 4)->nullable();
            $table->decimal('QAR', 10, 4)->nullable();
            $table->decimal('KGS', 10, 4)->nullable();
            $table->decimal('CNY', 10, 4)->nullable();
            $table->decimal('MDL', 10, 4)->nullable();
            $table->decimal('NZD', 10, 4)->nullable();
            $table->decimal('NOK', 10, 4)->nullable();
            $table->decimal('PLN', 10, 4)->nullable();
            $table->decimal('RON', 10, 4)->nullable();
            $table->decimal('XDR', 10, 4)->nullable();
            $table->decimal('SGD', 10, 4)->nullable();
            $table->decimal('TJS', 10, 4)->nullable();
            $table->decimal('THB', 10, 4)->nullable();
            $table->decimal('TRY', 10, 4)->nullable();
            $table->decimal('TMT', 10, 4)->nullable();
            $table->decimal('UZS', 10, 4)->nullable();
            $table->decimal('UAH', 10, 4)->nullable();
            $table->decimal('CZK', 10, 4)->nullable();
            $table->decimal('SEK', 10, 4)->nullable();
            $table->decimal('CHF', 10, 4)->nullable();
            $table->decimal('RSD', 10, 4)->nullable();
            $table->decimal('ZAR', 10, 4)->nullable();
            $table->decimal('KRW', 10, 4)->nullable();
            $table->decimal('JPY', 10, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
