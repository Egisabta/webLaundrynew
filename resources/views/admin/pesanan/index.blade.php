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
                    <!-- Wrap the table in a div for horizontal scrolling -->
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Tanggal Pesan</th>
                                <th class="text-center">Kode Transaksi</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Jenis Paket</th>
                                <th class="text-center">Berat /KG</th>
                                <th class="text-center">Diantar</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Status Pembayaran</th>
                                <th class="text-center">Tanggal Pembayaran</th>
                                <th class="text-center">Status Laundry</th>
                                <th class="text-center">Tanggal Pengambilan</th>
                                <th class="text-center">Catatan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = count($allDataPesanan); @endphp
                            @foreach($allDataPesanan->reverse() as $data)
                            <tr>
                                <th class="text-center" max-width="15px" scope="row">{{ $i-- }}</th>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pesan)->format('d F Y') }}
                                </td>
                                <td class="text-center">{{ $data->kd_transaksi }}</td>
                                
                                <td class="text-center">
                                    @if (isset($data->pelanggans))
                                        {{ $data->pelanggans->nama }}
                                    @else
                                        <span style="color: red;">Data Hilang</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (isset($data->pakets))
                                        {{ $data->pakets->nama_paket }}-Rp.{{ number_format($data->pakets->harga, 2) }} 
                                    @else
                                        <span style="color: red;">Data Hilang</span>
                                    @endif
                                </td>
                                 <td class="text-center">{{ $data->berat }} kg</td>
                                 <td class="text-center">
                                 @if ($data->delivery)
                                    Ya
                                  @else
                                    Tidak
                                  @endif
                                  </td>
                                <td class="text-center">
                                    Rp.{{ number_format($data->total_bayar, 2) }}
                                    @if ($data->diskon_persen)
                                    <br>
                                    <span class="text-muted" style="font-size: 12px;">
                                        Diskon {{ $data->diskon_persen }}%
                                    </span>
                                    @endif
                                    @if ($data->pajak_persen)
                                    <br>
                                    <span class="text-muted" style="font-size: 12px;">
                                        Pajak {{ $data->pajak_persen }}%
                                    </span>
                                    @endif
                                    @if ($data->biaya_delivery)
                                    <br>
                                    <span class="text-muted" style="font-size: 12px;">
                                        Biaya Antar Rp.{{ $data->biaya_delivery }}
                                    </span>
                                    @endif
                                    </td>

                                <td class="text-center">{{ $data->status_pembayaran }}</td>

                                <td class="text-center">
                                @if ($data->tgl_pembayaran)
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pembayaran)->format('d F Y') }}
                                @else
                                <span style="color: red;">-</span>
                                @endif
                                </td>

                                <td class="text-center">
                                <form action="{{ route('pesanan.updateStatus', $data->id) }}" method="POST">
                                 @csrf
                                 @method('POST')
                                 <select name="status" onchange="this.form.submit()">
                                 <option value="Baru" {{ $data->status == 'Baru' ? 'selected' : '' }}>Baru</option>
                                 <option value="Proses" {{ $data->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                 <option value="Diantar" {{ $data->status == 'Diantar' ? 'selected' : '' }}>Diantar</option>
                                 <option value="Selesai" {{ $data->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                  </select>
                                  </form>
                                  </td>


                                <td class="text-center">
                                @if ($data->tgl_pengambilan)
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pengambilan)->format('d F Y') }}
                                @else
                                <span style="color: red;">-</span>
                                @endif
                                </td>

                                <td class="text-center">
                                @if ($data->catatan)
                                {{ $data->catatan }}
                                @else
                                <span style="color: red;">-</span>
                                @endif
                                </td>

                                <td >
                                  <a href="{{ route('pesanan.invoice', $data->kd_transaksi) }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print fa-lg" style="color:white"></i></a>
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
</div>


<!-- <script>
   $('.edit-status').on('change', function() {
    var selectedStatus = $(this).val();
    var dataId = $(this).data('id');

   
    $.ajax({
        url: '/update-status/' + dataId, 
        method: 'POST',
        data: { status: selectedStatus, _token: '{{ csrf_token() }}' },
        success: function(response) {
          
        },
        error: function(error) {
          
        }
    });
});

</script> -->


@endsection
