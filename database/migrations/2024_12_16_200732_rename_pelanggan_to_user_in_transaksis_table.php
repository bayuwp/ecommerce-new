<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambahkan kolom user_id
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
        });

        // Salin data dari pelanggan_id ke user_id
        DB::statement('UPDATE transaksis SET user_id = pelanggan_id');

        // Hapus kolom pelanggan_id
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['pelanggan_id']);
            $table->dropColumn('pelanggan_id');
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('pelanggan_id')->nullable()->after('id')->constrained('pelanggans')->onDelete('cascade');
        });

        // Salin data dari user_id ke pelanggan_id
        DB::statement('UPDATE transaksis SET pelanggan_id = user_id');

        // Hapus kolom user_id
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
