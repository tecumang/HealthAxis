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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id'); // Foreign key to reports table
            $table->string('test_name'); // E.g., "Neutrophil", "Lymphocyte"
            $table->decimal('result', 10, 2); // Test result (e.g., 5.90, 3.14)
            $table->string('unit'); // Unit for the result (e.g., "x10^9/L")
            $table->string('reference_range'); // Reference range (e.g., "2-7")
            $table->text('description')->nullable(); // Additional description, if necessary
            $table->timestamps(); // created_at, updated_at

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
