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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',125);
            $table->string('slug',125);
            $table->unsignedBigInteger('product_type_id')->index();
            $table->string('status')->default(\App\Enums\StatusEnum::Enabled->value);
            $table->foreign('product_type_id')->references('id')
               ->on('product_types') ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
