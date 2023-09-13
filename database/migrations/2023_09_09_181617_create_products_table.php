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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status')->default(\App\Enums\StatusEnum::Enabled->value);
            $table->string('name',125);
            $table->string('slug',125);
            $table->string('product_sku',125);
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('product_type_id')->index();
            $table->unsignedBigInteger('product_weight_id')->index();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('product_type_id')->references('id')
            ->on('product_types')->cascadeOnDelete();
            $table->foreign('product_weight_id')->references('id')
                ->on('product_weights')->cascadeOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
