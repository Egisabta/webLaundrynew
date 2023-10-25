@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Edit Paket</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form method="post" action="{{route('paket.update', $editData->id)}}" enctype="multipart/form-data">
                          @csrf

                          <div class="mb-3">
                                <label class="form-label" for="formGroupExampleInput">Kode Paket</label>
                                <input class="form-control" id="formGroupExampleInput" type="text" placeholder="" name="kd_paket" value="{{$editData->kd_paket}}" readonly>
                            </div>  
                          
                        <div class="mb-3">
                          <label class="form-label" for="formGroupExampleInput">Nama Paket</label>
                          <input class="form-control" id="formGroupExampleInput" type="text" placeholder="" name="nama_paket" value="{{$editData->nama_paket}}">
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="formGroupExampleInput2">Deskripsi Paket</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{$editData->deskripsi}}</textarea>
                         </div>
                    
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">Masukkan Harga</label>
                          <input class="form-control" type="text" name="harga"  value="{{$editData->harga}}" aria-label=""><span class="input-group-text">/kg</span>
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