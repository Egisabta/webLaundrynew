@extends('backend.master')
@section('backend')
<div class="card mb-4">
            <div class="card-header"><strong>Table Pesanan</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">          
                  <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
                  <a href="{{route('pesanan.add')}}"><button style=" width: 90px; height: 38px; font-size: 16px; border-radius: 4px;  float: right;  padding: 2px 2px;  margin-bottom: 25px;" type="button"  class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
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
                          <td class="text-center" >{{$data->pelanggans->nama}}</td>
                          <td class="text-center">{{$data->pakets->nama_paket}}</td>
                          <td class="text-center">
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pesan)->format('d F Y') }}</td>
                          </td>
                          <td class="text-center">{{$data->berat}} kg</td>

                          <td class="text-center">
                          Rp.{{ number_format($data->total_bayar, 2) }}
                          @if ($data->diskon_persen)
                          <br>
                          <span class="text-muted" style="font-size: 12px;">
                          Diskon {{ $data->diskon_persen }}%
                          </span>
                          @endif
                          </td>
                          
                          <!-- @if($data->diskon)
                          {{ number_format($data->total_bayar - $data->diskon, 2) }}
                           @else
                          {{ number_format($data->total_bayar, 2) }}
                           @endif -->
                          </td>

                          <td class="text-center">
                          @if ($data->pembayarans->isEmpty())
                          <span class="text-danger">Belum Bayar</span>
                          <br>
                          <a href="{{ route('nota.no', ['id' => $data->id]) }}" class="small">Cetak Nota </a>
                          @else
                          @foreach ($data->pembayarans as $pembayaran)
                         <span class="text-success">{{ $pembayaran->status_pembayaran }}</span>
                         <br>
                         <a href="#" class="small">Cetak Nota</a>
                        @endforeach
                        @endif

                       </td>

                          <td class="text-center">
                          <a href="{{ route('pembayaran.add', ['pesanan_id' => $data->id]) }}" class="btn btn-info btn-sm">
                          <i class="fa fa-money-bill-alt fa-lg" style="color:white"></i>
                          </a>
                        <a href="{{ route('pesanan.edit', $data->id) }}"class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg" style="color:white"></i></a>
                        <a href="{{route('pesanan.delete', $data->id)}}" id="delete" class="btn btn-danger btn-sm"  ><i class="fa fa-trash fa-lg" style="color:white"></i></a>
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
@endsection