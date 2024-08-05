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
        Schema::table('thicknesses', function (Blueprint $table) {
            $table->unsignedBigInteger('catalog_id')->after('id')->nullable();
            $table->foreign('catalog_id')->references('id')->on('catalogs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thicknesses', function (Blueprint $table) {
            $table->dropForeign('thicknesses_catalog_id_foreign');
            $table->dropColumn('catalog_id');
        });
    }
};
