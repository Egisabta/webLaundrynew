@extends('backend.master')
@section('backend')

<div class="col-12">
              <div class="card mb-4">
                <div class="card-header"><strong>Pembayaran</strong><span class="small ms-1"></span></div>
                <div class="card-body">    
                  <div class="example">     
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                      <form action="{{ route('cekStatus.update', $cekStatus->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="status_laundry">Status Laundry</label>
                                <select class="form-control" id="status_laundry" name="status_laundry">
                                    <option value="A" {{ $cekStatus->status_laundry === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ $cekStatus->status_laundry === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ $cekStatus->status_laundry === 'C' ? 'selected' : '' }}>C</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengambilan">Tanggal Pengambilan</label>
                                <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan" value="{{ $cekStatus->tanggal_pengambilan }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection




