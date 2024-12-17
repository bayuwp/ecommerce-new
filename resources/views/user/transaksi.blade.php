@extends('user.app')

@section('container')
<div class="container">
    <h2>Riwayat Transaksi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Pilih</th>
                <th>ID Order</th>
                <th>User</th>  <!-- Ganti 'Pelanggan' menjadi 'User' -->
                <th>Produk</th>
                <th>Payment Type</th>
                <th>Gross Amount</th>
                <th>Transaction Time</th>
                <th>Transaction Status</th>
                <th>Metadata</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaktions as $transaksi)
                <tr>
                    <td>
                        <input type="checkbox" class="transaction-checkbox" data-amount="{{ $transaksi->gross_amount }}" aria-label="Pilih transaksi {{ $transaksi->order_id }}">
                    </td>
                    <td>{{ $transaksi->order_id }}</td>
                    <td>{{ $transaksi->user->name ?? 'N/A' }}</td> <!-- Menampilkan nama user yang terkait -->
                    <td>{{ $transaksi->produk->nama ?? 'N/A' }}</td>
                    <td>{{ $transaksi->payment_type ?? 'N/A' }}</td>
                    <td>Rp {{ number_format($transaksi->gross_amount, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->transaction_time ? \Carbon\Carbon::parse($transaksi->transaction_time)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                    <td>{{ ucfirst($transaksi->transaction_status) }}</td>
                    <td>
                        <pre class="bg-light p-2">{{ json_encode(json_decode($transaksi->metadata), JSON_PRETTY_PRINT) }}</pre>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="showDetails('{{ $transaksi->order_id }}')">Detail</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTransaction('{{ $transaksi->order_id }}')">Hapus</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada transaksi ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
