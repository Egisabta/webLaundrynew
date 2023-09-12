@extends('backend.master')
@section('backend')



<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Tambah Pesanan</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <!-- <form action="{{ route('paket.store') }}" method="post" enctype="multipart/form-data">
                      @csrf -->

                      
               

                      <!-- <div class="input-group mb-3">
                      <input id="search-focus" type="search" id="form1" class="form-control" placeholder="Cari Nama Pelanggan"/>
                     <button type="button" class="btn btn-primary">
                     <i class="fas fa-search"></i>
                     </button>
                      </div> -->

                      <div class="form-grup mb-3">
                         <select class="form-select " aria-label="Default select example" name="" id="pelanggan">
                         <option value="" disabled selected>Nama Pelanggan</option> <!-- Placeholder option -->
                          @foreach ($pelanggan as $data)            
                          <option value="{{$data->id}}">{{$data->nama}}</option>
                           @endforeach
                          </select>
                          </div>
                       
                      <div class="form-grup mb-3">
                      <select id="" class="form-select " aria-label="Default select example" name="">
                      <option selected disabled>Paket Yang Dipilih</option> 
                      @foreach ($paket as $data)            
                          <option value="{{$data->id}}">{{$data->nama_paket}}</option>
                           @endforeach
                      </select>
                       </div>
                                                  
                    
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">Berat</label>
                          <input class="form-control @error('harga') is-invalid @enderror" type="text" name="harga" aria-label=""><span class="input-group-text">/kg</span>
                          <!-- @error('harga')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror -->
                        </div> 

                     

                      
                         <div class="input-group mb-3">
                         <label for="inputField" class="input-group-text">Tanggal Masuk</label>
                         <input class="form-control" id="tanggalMasuk" data-date-format="dd-mm-yyyy"  type="text"/>
                         <span class="input-group-text"><i class="fa fa-calendar"></i></span> 
                         </div>

                         <div class="input-group mb-3">
                         <label for="inputField" class="input-group-text">Tanggal Keluar</label>
                         <input class="form-control" id="tanggalKeluar" data-date-format="dd-mm-yyyy"  type="text"/>
                         <span class="input-group-text"><i class="fa fa-calendar"></i></span> 
                         </div>

                         <div class="form-grup mb-3">
                         <select class="form-select " aria-label="Default select example" name="" id="">
                         <option selected disabled>Pilih Status</option> 
                                   
                          <option></option>
                         
                          </select>
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




