<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jenisPembayaran;


class jenisPembayaranController extends Controller
{
    public function index(){ 
        $jenisPem = jenisPembayaran::all();
        return view('backend.jenisPembayaran.index', compact('jenisPem'));
      }

   public function add(){
       return view('backend.jenisPembayaran.add');
   }

   public function store(Request $request){
    $rules=[
      'jenis_pembayaran' => 'required'
     ];

       $messages =[
         'jenis_pembayaran.required' => '*Jenis Pembayaran Harus Diisi' 
     ];

     $this->validate($request,$rules,$messages);
  
      $jenisPem = new jenisPembayaran(); 
      $jenisPem->jenis_pembayaran=$request->input('jenis_pembayaran'); 
      $jenisPem->save();
      return redirect()->route('jenisPembayaran.index')->with('success', 'Banner berhasil ditambahkan');
   }
   public function edit(Request $request, $id){
    $editData = jenisPembayaran::findOrFail($id);
     return view('backend.jenisPembayaran.edit', compact('editData'));
}
    public function update(Request $request, $id){
    $editData=jenisPembayaran::find($id);
     $validateData= $request->validate([
        'jenis_pembayaran' => 'required',
       
   
     ]);
     $editData->update([
        'jenis_pembayaran'=> $request->input('jenis_pembayaran'),

        
     ]);
     return redirect()->route('jenisPembayaran.index')->with('success','Tambah Bahan berhasil');

}
public function delete($id){
  $jenisPem=jenisPembayaran::find($id);

  $jenisPem->delete();
 return  redirect()->route('jenisPembayaran.index')->with('success', 'data berhasil di hapus');

}
}
