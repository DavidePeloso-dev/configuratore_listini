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
        Schema::table('components', function (Blueprint $table) {
            $table->unsignedBigInteger('thickness_id')->after('name')->nullable();
            $table->foreign('thickness_id')->references('id')->on('thicknesses')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropForeign('components_thickness_id_foreign');
            $table->dropColumn('thickness_id');
        });
    }
};
