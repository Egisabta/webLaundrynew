@extends('backend.master')
@section('backend')
<div class="card mb-4">
            <div class="card-header"><strong>Table Jenis Pembayaran</strong></div>
            <div class="card-body">
              <div class="example">
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">          
                  <table id="datatable" class="table table-bordered dt-responsive" cellspacing="0" width="100%">
                  <a href="{{route('jenisPembayaran.add')}}"><button style=" width: 90px; height: 38px; font-size: 16px; border-radius: 4px;  float: right;  padding: 2px 2px;  margin-bottom: 25px;" type="button"  class="btn btn-primary waves-light btn-sm waves-effect">Tambah</button></a>
                      <thead>
                        <tr>
                          <th class="text-center">No</th>
                          <th class="text-center">Jenis Pembayaran</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($jenisPem as $data)
                        <tr>
                          <th class="text-center" max-width="15px" scope="row">{{$loop->iteration}}</th>
                          <td style=""> {{$data->jenis_pembayaran}}</td>
                    
                          
                          <td class="text-center" style="max-width:70px;">
                         <!-- <a href=""class="btn btn-success btn-sm"><i class="fa fa-eye fa-lg" style="color:white"></i></a> -->
                        <a href="{{ route('jenisPembayaran.edit', $data->id) }} "class="btn btn-warning btn-sm"><i class="fa fa-edit fa-lg" style="color:white"></i></a>
                        <a href="{{ route('jenisPembayaran.delete', $data->id) }}" id="delete" class="btn btn-danger btn-sm"  ><i class="fa fa-trash fa-lg" style="color:white"></i></a>
                          </td>
   
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection