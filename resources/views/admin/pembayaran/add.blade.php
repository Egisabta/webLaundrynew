@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Pembayaran</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form action="{{ route('pembayaran.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      
                      <input type="hidden" name="pesanan_id" value="{{ $pesananId }}">


                      <fieldset disabled>
                      <div class="form-group mb-3">
                     <label for="disabledTextInput" class="form-label" style="color: green;">*Nama Pelanggan</label>
                     <input type="text" id="disabledTextInput" class="form-control" value="{{ $namaPelanggan }}" placeholder="">
                     </div>
                     </fieldset>

                    <fieldset disabled>
                    <div class="form-group mb-3">
                    <label for="disabledTextInput" class="form-label" style="color: green;">*Total Pembayaran</label>
                    <input type="text" id="disabledTextInput" class="form-control" value="Rp.{{number_format($totalPembayaran, 2) }}" placeholder="">
                    </div>
                    </fieldset>



                    <div class="form-grup mb-3">
                          <select id="" class="form-select " aria-label="Default select example" name="metode_pembayaran">
                          <option selected disabled>Paket Yang Dipilih</option> 
                           @foreach ($jenisPembayaran as $data)            
                          <option value="{{$data->id}}">{{$data->jenis_pembayaran}}</option>
                           @endforeach
                          </select>
                           </div>  

                      <div class="input-group mb-3">
                        <label for="tgl_pembayaran" class="input-group-text">Tanggal Pembayaran</label>
                        <input class="form-control" id="tgl_pembayaran"  type="text" name="tanggal_pembayaran"/>
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
  
                          <div class="form-grup mb-3">
                          <select name="status_pembayaran" class="form-select" id="status_pembayaran" required>
                          <option selected disabled>Status Pembayaran</option>
                          <option value="Lunas">Lunas</option>
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




