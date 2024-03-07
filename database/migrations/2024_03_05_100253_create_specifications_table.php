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
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->uuid()->index()->unique();
            $table->string('title');
            $table->foreignIdFor(\App\Models\Product::class);
            $table->string('size', 20)->nullable();
            $table->string('color', 50);
            $table->float('price');
            $table->float('discount')->default(0);
            $table->string('photo')->nullable();
            $table->integer('stock')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
