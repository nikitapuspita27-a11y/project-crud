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
    if (!Schema::hasColumn('barangs', 'gambar')) {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('gambar')->nullable();
        });
    }
}

public function down(): void
{
    Schema::table('barangs', function (Blueprint $table) {
        $table->dropColumn('gambar');
    });
}
};
