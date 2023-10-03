@extends('backend.master')
@section('backend')
<div class="card mb-4">
            <div class="card-header"><strong>Cek Status Laundry</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">          
                  <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
            
                      <thead>
                        <tr>
                          <th class="text-center">ID Pesan</th>
                          <th class="text-center">Nama Pelanggan</th>
                          <th class="text-center">Tanggal Pesan</th>
                          <th class="text-center">Pembayaran</th>
                          <th class="text-center">Tanggal Bayar</th>
                          <th class="text-center">Status Laundry</th>
                          <th class="text-center">Tanggal Pengambilan</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      
                      @foreach($pesanData as $key => $pesan)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">{{ $pesan->pelanggans->nama }}</td>
                        <td class="text-center">  
                          {{ \Carbon\Carbon::createFromFormat('Y-m-d', $pesan->tgl_pesan)->format('d F Y') }}
                        </td>
                        <td class="text-center">
                            @if ($pesan->pembayarans->isEmpty())
                            <span class="text-danger">Belum Bayar</span>
                            @else
                            @foreach ($pesan->pembayarans as $pembayaran)
                            <span class="text-success">{{ $pembayaran->status_pembayaran }}</span>
                            @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($pesan->pembayarans->isEmpty())
                            <span class="text-danger">-</span>
                            @else
                            @foreach ($pesan->pembayarans as $tglBayar)        
                            <span class="text-success">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $tglBayar->tanggal_pembayaran)->format('d F Y') }}</span>
                            @endforeach
                            @endif
                        </td>
                        <td>
                         </td>
                         <td>
                         </td>
   
                       <td class="text-center" style="max-width:70px;"> 
                       <a href="{{ route('cekStatus.edit', ['id' => $pesan->id]) }}" class="btn btn-warning btn-sm">
                         <i class="fa fa-edit fa-lg" style="color:white"></i>
                         </a>
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