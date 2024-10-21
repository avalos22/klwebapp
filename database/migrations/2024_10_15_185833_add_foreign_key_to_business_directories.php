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
        Schema::table('business_directories', function (Blueprint $table) {
            $table->foreign('factory_company_id')
                ->references('id')->on('factory_companies')
                ->onDelete('set null'); // O puedes usar 'cascade' si prefieres eliminar la relación en cascada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_directories', function (Blueprint $table) {
            $table->dropForeign(['factory_company_id']);
        });
    }
};
