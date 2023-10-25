<!DOCTYPE html>
<html>
<head>
    <title>Nota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        </div>
        <div class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>Berat</th>
                        <th>Jenis Paket</th>
                        <th>Deskripsi Paket</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >{{ $pesanan->berat }}</td>
                        <td>{{ $pesana }}</td>
                        <td>1</td>
                        <td>Rp. {{ number_format(100.00, 2) }}</td>
                        <td>Rp. {{ number_format(100.00, 2) }}</td>
                    </tr>
                    <!-- Add more line items as needed -->
                </tbody>
            </table>
        </div>
        <div class="invoice-total">
            <!-- Invoice totals (e.g., subtotal, taxes, discounts, and final total) -->
            <p>Subtotal: Rp. {{ number_format(100.00, 2) }}</p>
            <!-- Add more totals as needed -->
        </div>
    </div>
</body>
</html>
