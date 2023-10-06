@extends('backend.master')
@section('backend')
<div class="card mb-4">
    <div class="card-header"><strong>Table Pesanan</strong></div>
    <div class="card-body">
        <div class="example">
            <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('pesanan.add') }}">
                            <button style="width: 90px; height: 38px; font-size: 16px; border-radius: 4px; float: right; padding: 2px 2px; margin-bottom: 25px;" type="button" class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button>
                        </a>
                        <form method="GET" action="{{ route('pesanan.search') }}">
                            <div class="input-group">
                                <input type="text" name="keyword" id="search-input" class="form-control" placeholder="Cari data">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Jenis Paket</th>
                                <th class="text-center">Tanggal Pesan</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Status Bayar</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = count($allDataPesanan); @endphp
                            @foreach($allDataPesanan->reverse() as $data)
                            <tr>
                                <th class="text-center" max-width="15px" scope="row">{{ $i-- }}</th>
                                <td class="text-center">
                                    @if (isset($data->pelanggans))
                                        {{ $data->pelanggans->nama }}
                                    @else
                                        <span style="color: red;">Data Hilang</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (isset($data->pakets))
                                        {{ $data->pakets->nama_paket }}
                                    @else
                                        <span style="color: red;">Data Hilang</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pesan)->format('d F Y') }}
                                </td>
                                <td class="text-center">{{ $data->berat }} kg</td>
                                <td class="text-center">
                                    Rp.{{ number_format($data->total_bayar, 2) }}
                                    @if ($data->diskon_persen)
                                    <br>
                                    <span class="text-muted" style="font-size: 12px;">
                                        Diskon {{ $data->diskon_persen }}%
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($data->pembayarans->isEmpty())
                                        <span class="text-danger">Belum Bayar</span>
                                        <br>
                                        <button class="small btn btn-link" onclick="showInvoiceModal({{ $data->id }}, 'Belum Bayar')">Invoice</button>
                                    @else
                                        @foreach ($data->pembayarans as $pembayaran)
                                            <span class="text-success">{{ $pembayaran->status_pembayaran ?? 'Belum Bayar' }}</span>
                                            <br>
                                            <button class="small btn btn-link" onclick="showInvoiceModal({{ $data->id }}, 'Lunas')">Invoice</button>

                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pembayaran.add', ['pesanan_id' => $data->id]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-money-bill-alt fa-lg" style="color:white"></i>
                                    </a>
                                    <a href="{{ route('pesanan.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg" style="color:white"></i></a>
                                    <a href="{{ route('pesanan.delete', $data->id) }}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-lg" style="color:white"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Nota Laundry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <p>Nama Pelanggan: <span id="invoiceNamaPelanggan"></span></p>
            <p>Jenis Paket: <span id="invoiceJenisPaket"></span></p>
            <p>Tanggal Pesan: <span id="invoiceTanggalPesan"></span></p>
            <p>Berat: <span id="invoiceBerat"></span> kg</p>
            <p>Total Bayar: Rp.<span id="invoiceTotalBayar"></span></p>
            <p>Diskon: <span id="invoiceDiskon"></span></p>
            <p>Status Bayar: <span id="invoiceStatusBayar"></span></p>
            <p>Tanggal Pembayaran: <span id="invoiceTanggalPembayaran"></span></p>
            <p>Metode Pembayaran: <span id="invoiceMetodePembayaran"></span></p>
                <p>Tanggal Pembayaran: <span id="invoiceTanggalPembayaran"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="cetakInvoice()">Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showInvoiceModal(pesananId, statusPembayaran) {
        // Tampilkan modal invoice dan isi informasi pelanggan
        var data = @json($allDataPesanan);
        var pesanan = data.find(function(item) {
            return item.id === pesananId;
        });

        if (pesanan) {
            document.getElementById('invoiceNamaPelanggan').textContent = pesanan.pelanggans ? pesanan.pelanggans.nama : 'Data Hilang';
            document.getElementById('invoiceJenisPaket').textContent = pesanan.pakets ? pesanan.pakets.nama_paket : 'Data Hilang';
            var tglPesan = new Date(pesanan.tgl_pesan);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('invoiceTanggalPesan').textContent = tglPesan.toLocaleDateString('id-ID', options);
            document.getElementById('invoiceBerat').textContent = pesanan.berat;
            var formattedTotalBayar = new Intl.NumberFormat('id-ID').format(pesanan.total_bayar);
            document.getElementById('invoiceTotalBayar').textContent = formattedTotalBayar;

            if (pesanan.diskon_persen) {
                document.getElementById('invoiceDiskon').textContent = pesanan.diskon_persen + '%';
            } else {
                document.getElementById('invoiceDiskon').textContent = 'Tidak ada diskon';
            }

            if (statusPembayaran === 'Lunas') {
    document.getElementById('invoiceStatusBayar').textContent = 'Lunas';
    document.getElementById('invoiceMetodePembayaran').textContent = pesanan.metode_pembayaran;
    document.getElementById('invoiceTanggalPembayaran').textContent = pesanan.tanggal_pembayaran; 
    document.getElementById('invoiceMetodePembayaran').style.display = 'block';
    document.getElementById('invoiceTanggalPembayaran').style.display = 'block';
} else {
    document.getElementById('invoiceStatusBayar').textContent = 'Belum Bayar';
    document.getElementById('invoiceMetodePembayaran').style.display = 'none';
    document.getElementById('invoiceTanggalPembayaran').style.display = 'none';
}

      }

        $('#invoiceModal').modal('show');
    }

    function cetakInvoice() {
        // Logika pencetakan invoice (Anda perlu menambahkan logika cetak di sini)
        // Misalnya, menggunakan jsPDF atau cara lain untuk mencetak
        // Anda juga dapat mencetak menggunakan server jika diperlukan.
    }
</script>


@endsection
