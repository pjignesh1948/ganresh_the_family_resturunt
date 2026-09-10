<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vegetables', function (Blueprint $table) {
            if (! Schema::hasColumn('vegetables', 'name_hi')) {
                $table->string('name_hi')->nullable()->after('name');
            }
            if (! Schema::hasColumn('vegetables', 'name_gu')) {
                $table->string('name_gu')->nullable()->after('name_hi');
            }
            if (! Schema::hasColumn('vegetables', 'description_hi')) {
                $table->text('description_hi')->nullable()->after('description');
            }
            if (! Schema::hasColumn('vegetables', 'description_gu')) {
                $table->text('description_gu')->nullable()->after('description_hi');
            }
        });

        Schema::table('menu_items', function (Blueprint $table) {
            if (! Schema::hasColumn('menu_items', 'name_gu')) {
                $table->string('name_gu')->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'name_gu')) {
                $table->dropColumn('name_gu');
            }
        });

        Schema::table('vegetables', function (Blueprint $table) {
            foreach (['name_hi', 'name_gu', 'description_hi', 'description_gu'] as $col) {
                if (Schema::hasColumn('vegetables', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
