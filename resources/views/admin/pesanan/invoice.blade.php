<!DOCTYPE html>
<html>
<head>
    <title>Nota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        th, td {
            text-align: center; /* Mengatur teks ke tengah */
        }

        .invoice {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header {
            text-align: left;
        }
        .invoice-logo {
            flex: 1;
        }

        .invoice-logo img {
            max-width: 100px; /* Adjust the size as needed */
        }

        .invoice-details {
            margin-top: 20px;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items th, .invoice-items td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-logo">
            <img src="logo.png" alt="Company Logo"> <!-- Ganti "logo.png" dengan URL atau path ke logo perusahaan Anda -->
        </div>
        <div class="invoice-header">
            <h3>Alisha Laundry</h3>
            <p>Your Company Address</p>
        </div>
      
        <div class="invoice-details">
            <p>Invoice #: {{ $pesanan->kd_transaksi }}</p>
            <p>Nama Pelanggan : {{ $pesanan->pelanggans->nama }}</p>
            <p>Tanggal Pesan :   {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pesanan->tgl_pesan)->format('d F Y') }}</p>
            <p>Status Pembayaran : {{ $pesanan->status_pembayaran }}</p>
            <p>Tanggal Pembayaran :  @if ($pesanan->tgl_pembayaran)
                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pesanan->tgl_pembayaran)->format('d F Y') }}
                @else
                <span style="color: red;">-</span>
                @endif</p>
        </div>
        <div class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>Berat/Kg</th>
                        <th>Jenis Paket</th>
                        <th>Deskripsi Paket</th>
                        <th>Harga Paket</th>
                        <th>Diskon(%)</th>
                        <th>Pajak(%)</th>
                        <th>Diantar</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >{{ $pesanan->berat }}</td>
                        <td>{{ $pesanan->pakets->nama_paket }}</td>
                        <td>{{ $pesanan->pakets->deskripsi }}</td>
                        <td> Rp.{{ number_format($pesanan->pakets->harga, 2) }}</td>
                        <td>
                            @if (isset($pesanan->diskon_persen))
                            {{ $pesanan->diskon_persen }} %
                            @else
                            <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td>
                            @if (isset($pesanan->pajak_persen))
                            {{ $pesanan->pajak_persen }} %
                            @else
                            <span style="color: red;">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($pesanan->delivery)
                            Ya
                          @else
                            Tidak
                          @endif
                          @if ($pesanan->biaya_delivery)
                          <br>
                          <span class="text-muted" style="font-size: 12px;">
                              Biaya Antar Rp.{{ $pesanan->biaya_delivery }}
                          </span>
                          @endif
                        </td>
                        <td>
                            @if ($pesanan->catatan)
                            {{ $pesanan->catatan }}
                            @else
                            <span style="color: red;">-</span>
                            @endif
                        </td>
                       
                    </tr>               
                </tbody>
            </table>
        </div>
        <div class="invoice-total">
            <p>Subtotal: Rp.{{ number_format($pesanan->total_bayar, 2) }}</p>
        </div>
    </div>
</body>
</html>
