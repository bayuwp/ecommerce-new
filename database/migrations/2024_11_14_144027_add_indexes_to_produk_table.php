<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->index('kategori_id');
            $table->index('nama');
            $table->index('harga');
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropIndex(['kategori_id']);
            $table->dropIndex(['nama']);
            $table->dropIndex(['harga']);
        });
    }
};
