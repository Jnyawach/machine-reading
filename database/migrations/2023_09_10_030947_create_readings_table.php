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
        Schema::create('readings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status')->default(\App\Enums\StatusEnum::Enabled->value);
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('shift_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('confirm_by_id')->nullable();
            $table->integer('reading_entry');
            $table->decimal('automatic_count',10,2);
            $table->decimal('reading_count',10,2);
            $table->unsignedBigInteger('machine_id');
            $table->string('confirm_status')->default(\App\Enums\ConfirmStatusEnum::Pending->value);
            $table->timestamp('confirmed_at')->nullable();
            $table->foreign('product_id')->references('id')
                ->on('products')->cascadeOnDelete();
            $table->foreign('shift_id')->references('id')
                ->on('shifts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')
            ->on('users')->cascadeOnDelete();
            $table->foreign('confirm_by_id')->references('id')
                ->on('users')->cascadeOnDelete();
            $table->foreign('machine_id')->references('id')
                ->on('machines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('readings');
    }
};
