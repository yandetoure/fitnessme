<?php declare(strict_types=1);

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
        Schema::create('nutrition_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('instructions')->nullable();
            $table->string('image')->nullable();
            $table->string('type'); // 'tisane', 'plat', 'supplement'
            $table->string('category'); // 'perte_poids', 'prise_poids', 'tonification', etc.
            $table->integer('calories')->nullable();
            $table->integer('preparation_time_minutes')->nullable();
            $table->string('difficulty')->default('easy'); // easy, medium, hard
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_items');
    }
};
