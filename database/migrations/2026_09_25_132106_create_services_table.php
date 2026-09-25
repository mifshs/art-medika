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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained()->cascadeOnDelete();
            $table->string('nomenclature_code')->nullable(); // B01.057.003
            $table->string('mis_code')->nullable();          // 3.2.4.1
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('unit')->default('услуга');
            $table->enum('duration_type', ['exact', 'up_to'])->default('exact');
            $table->unsignedInteger('duration_min')->nullable();
            $table->decimal('price', 10, 2)->nullable();             // обычная цена / «Бесплатно» = null
            $table->decimal('price_cat_1', 10, 2)->nullable();        // категории сложности I/II/III
            $table->decimal('price_cat_2', 10, 2)->nullable();
            $table->decimal('price_cat_3', 10, 2)->nullable();
            $table->json('problems')->nullable();             // «какие проблемы решает»
            $table->text('preparation')->nullable();          // «подготовка к операции»
            $table->text('execution')->nullable();            // «способ выполнения»
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
