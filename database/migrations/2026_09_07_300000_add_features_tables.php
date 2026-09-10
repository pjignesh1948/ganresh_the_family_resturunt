<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vegetables', function (Blueprint $table) {
            if (! Schema::hasColumn('vegetables', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
        });

        Schema::create('vegetable_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vegetable_id')->constrained()->cascadeOnDelete();
            $table->decimal('grams', 10, 2);
            $table->string('price_type', 20)->default('retail');
            $table->decimal('unit_price_per_kg', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->date('sold_date');
            $table->string('customer_note')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('home_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('image');
            $table->string('link')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('show_once')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('home_sliders');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('vegetable_sales');
        Schema::table('vegetables', function (Blueprint $table) {
            if (Schema::hasColumn('vegetables', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
