<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'transactions'; // Pastikan nama tabel sesuai dengan migrasi

    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'transaction_id',
        'order_id',
        'payment_type',
        'gross_amount',
        'transaction_time',
        'transaction_status',
        'metadata',
        'user_id',    // Ganti pelanggan_id dengan user_id
        'produk_id',
    ];

    /**
     * Mendefinisikan relasi banyak ke satu dengan model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relasi ke model User menggunakan kolom user_id
    }

    /**
     * Mendefinisikan relasi banyak ke satu dengan model Produk.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id'); // Relasi ke model Produk
    }
}
