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
        Schema::create('aid_distributions', function (Blueprint $table) {
           $table->id();
            $table->foreignId('beneficiary_id')->constrained()->onDelete('cascade');
            $table->foreignId('donation_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('aid_type'); // Cash / Goods
            $table->date('distribution_date');
            $table->text('remarks')->nullable();
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aid_distributions');
    }
};
