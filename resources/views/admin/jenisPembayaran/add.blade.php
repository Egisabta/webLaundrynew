@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Tambah Paket</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form action="{{ route('jenisPembayaran.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                        <div class="mb-3">
                          <label class="form-label" for="formGroupExampleInput">Jenis Pembayaran</label>
                          <input class="form-control  @error('jenis_pembayaran') is-invalid @enderror" id="formGroupExampleInput" type="text" placeholder="Nama Pembayaran" name="jenis_pembayaran">
                           @error('jenis_pembayaran')
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