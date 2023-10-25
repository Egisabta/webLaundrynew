@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Tambah Paket</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form action="{{ route('paket.store') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      <fieldset disabled>
                            <div class="form-group">
                            <label for="disabledTextInput">Kode Paket</label>
                            <input type="text" id="disabledTextInput" class="form-control"  name="kd_paket" value="{{ $newKodePaket }}">
                            </div>
                            </fieldset>
                           
                        <div class="mb-3">
                          <label class="form-label" for="formGroupExampleInput">Nama Paket</label>
                          <input class="form-control  @error('nama_paket') is-invalid @enderror" id="formGroupExampleInput" type="text" placeholder="" name="nama_paket">
                           @error('nama_paket')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label class="form-label" for="formGroupExampleInput2">Deskripsi Paket</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
                         </div>
                    
                        <div class="input-group mb-3">
                        <label for="inputField" class="input-group-text">Masukkan Harga</label>
                          <input class="form-control @error('harga') is-invalid @enderror" type="number" name="harga" aria-label=""><span class="input-group-text">/kg</span>
                          @error('harga')
                            <div class="invalid-feedback">
                            {{$message}}
                            </div>
                            @enderror
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