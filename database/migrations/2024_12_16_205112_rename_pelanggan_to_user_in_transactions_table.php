<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Tambahkan kolom user_id
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Salin data dari pelanggan_id ke user_id
        DB::statement('UPDATE transactions SET user_id = pelanggan_id');

        // Hapus kolom pelanggan_id
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['pelanggan_id']);
            $table->dropColumn('pelanggan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Tambahkan kembali kolom pelanggan_id
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('pelanggan_id')->nullable()->after('id');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');
        });

        // Salin data dari user_id ke pelanggan_id
        DB::statement('UPDATE transactions SET pelanggan_id = user_id');

        // Hapus kolom user_id
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
