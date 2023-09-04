@extends('backend.master')
@section('backend')
<div class="card mb-4">
            <div class="card-header"><strong>Table Paket</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">   
                    <table class="table">
                    <a href= "{{route('paket.add')}}" ><button class="btn btn-info" type="button" style="float:right" >Tambah</button></a>
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Paket</th>
                          <th scope="col">Deskripsi</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection