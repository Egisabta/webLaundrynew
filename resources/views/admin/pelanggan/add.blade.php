@extends('backend.master')
@section('backend')

<div class="col-12">
    <div class="card mb-4">
        <div class="card-header"><strong>Tambah Pelanggan</strong><span class="small ms-1"></span></div>
        <div class="card-body">
            <div class="example">
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                        <form action="{{ route('pelanggan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                           
                            <fieldset disabled>
                            <div class="form-group">
                            <label for="disabledTextInput">Kode Pelanggan</label>
                            <input type="text" id="disabledTextInput" class="form-control"  name="kd_pelanggan" value="{{ $newKodePelanggan }}">
                            </div>
                            </fieldset>
                           

                            <div class="mb-3">
                                <label class="form-label" for="formGroupExampleInput">Nama Pelanggan</label>
                                <input class="form-control  @error('nama') is-invalid @enderror" id="formGroupExampleInput" type="text" placeholder="" name="nama">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="formGroupExampleInput2">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label for="inputField" class="input-group-text">No.Telp</label>
                                <input class="form-control @error('no_telp') is-invalid @enderror" type="text" name="no_telp" aria-label="">
                                @error('no_telp')
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
