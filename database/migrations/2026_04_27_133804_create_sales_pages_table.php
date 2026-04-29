<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->text('description');
            $table->text('key_features');
            $table->string('target_audience');
            $table->string('price');
            $table->text('unique_selling_points')->nullable();
            $table->string('template')->default('modern');
            // Generated fields stored as JSON
            $table->string('headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->text('generated_description')->nullable();
            $table->json('benefits')->nullable();
            $table->json('features_breakdown')->nullable();
            $table->text('social_proof')->nullable();
            $table->text('call_to_action')->nullable();
            $table->boolean('is_generated')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_pages');
    }
};
