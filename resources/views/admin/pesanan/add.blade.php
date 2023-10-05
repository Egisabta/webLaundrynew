@extends('backend.master')
@section('backend')



<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Tambah Pesanan</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form action="{{ route('pesanan.store') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      <div class="form-grup mb-3">
                         <select class="form-select " aria-label="Default select example" name="id_pelanggan" id="pelanggan">
                         <option disabled selected>Nama Pelanggan</option> <!-- Placeholder option -->
                          @foreach ($pelanggan as $data)            
                          <option value="{{$data->id}}">{{$data->nama}}-{{$data->alamat}}</option>
                           @endforeach
                          </select>
                          </div>

                          <div class="form-grup mb-3">
                          <select id="" class="form-select " aria-label="Default select example" name="id_paket">
                          <option selected disabled>Paket Yang Dipilih</option> 
                           @foreach ($paket as $data)            
                          <option value="{{$data->id}}">{{$data->nama_paket}}</option>
                           @endforeach
                          </select>
                           </div> 

                           <div class="input-group mb-3">
                        <label for="tgl_pesan" class="input-group-text">Tanggal Pesan</label>
                        <input class="form-control" id="tgl_pesan"  type="text" name="tgl_pesan"/>
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>

                                                  
      
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">Berat</label>
                          <input class="form-control " type="text" name="berat" aria-label=""><span class="input-group-text">/kg</span>
                        </div> 

                        
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">Diskon (%)</label>
                          <input class="form-control " type="number" name="diskon_persen" placeholder="Masukkan apabila memiliki diskon" aria-label=""><span class="input-group-text">%</span>
                        </div> 

                       

                        <button type="submit" class="btn btn-success" style="float: right;">Simpan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection




