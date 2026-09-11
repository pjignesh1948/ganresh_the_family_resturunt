<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            if (! Schema::hasColumn('staff', 'photo')) {
                $table->string('photo')->nullable()->after('role');
            }
            if (! Schema::hasColumn('staff', 'aadhar_number')) {
                $table->string('aadhar_number', 12)->nullable()->after('photo');
            }
            if (! Schema::hasColumn('staff', 'aadhar_card')) {
                $table->string('aadhar_card')->nullable()->after('aadhar_number');
            }
            if (! Schema::hasColumn('staff', 'state')) {
                $table->string('state')->nullable()->after('aadhar_card');
            }
            if (! Schema::hasColumn('staff', 'city')) {
                $table->string('city')->nullable()->after('state');
            }
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            foreach (['photo', 'aadhar_number', 'aadhar_card', 'state', 'city'] as $column) {
                if (Schema::hasColumn('staff', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
