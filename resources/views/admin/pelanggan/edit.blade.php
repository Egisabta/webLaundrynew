@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Edit Pelanggan</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form method="post" action="{{route('pelanggan.update', $editData->id)}}" enctype="multipart/form-data">
                          @csrf
                          <div class="mb-3">
                                <label class="form-label" for="formGroupExampleInput">Kode Pelanggan</label>
                                <input class="form-control" id="formGroupExampleInput" type="text" placeholder="" name="kd_pelanggan" value="{{$editData->kd_pelanggan}}" readonly>
                            </div>                     
                        <div class="mb-3">
                          <label class="form-label" for="formGroupExampleInput">Nama Pelanggan</label>
                          <input class="form-control" id="formGroupExampleInput" type="text" placeholder="" name="nama" value="{{$editData->nama}}">
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="formGroupExampleInput2">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" >{{$editData->alamat}}</textarea>
                         </div>
                    
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">No.Telp</label>
                          <input class="form-control" type="text" name="no_telp" aria-label="" value="{{$editData->no_telp}}">
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