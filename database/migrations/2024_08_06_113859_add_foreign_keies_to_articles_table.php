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
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('catalog_id')->after('id')->nullable();
            $table->foreign('catalog_id')->references('id')->on('catalogs')->cascadeOnDelete();

            $table->unsignedBigInteger('category_id')->after('catalog_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_category_id_foreign');
            $table->dropColumn('category_id');

            $table->dropForeign('articles_catalog_id_foreign');
            $table->dropColumn('catalog_id');
        });
    }
};
