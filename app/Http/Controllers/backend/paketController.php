<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;

class paketController extends Controller
{
    public function index(){ 
         $paket = Paket::all();
         return view('backend.paket.index', compact('paket'));
       }

    public function add(){
        return view('backend.paket.add');
    }

    public function store(Request $request){
     $rules=[
       'nama_paket' => 'required|unique:pakets',
       'deskripsi' => 'required',
       'harga' => 'required',
      ];
 
        $messages =[
          'nama_paket.required' => '*Nama paket harus diisi',
          'nama_paket.unique' => '*Nama paket Sudah Ada',
          'deskripsi.required' => '*Dekripsi harus diisi',
          'harga.required' => '*harga harus diisi' 
      ];
 
      $this->validate($request,$rules,$messages);
       $x = (float) $request->input('harga');

       $paket = new Paket(); 
       $paket->nama_paket=$request->input('nama_paket');
       $paket->deskripsi=$request->input('deskripsi');
       $paket->harga = $x;
   
      
       $paket->save();
       return redirect()->route('paket.index')->with('success', 'Banner berhasil ditambahkan');
 
    }
    public function edit(Request $request, $id){
        $editData = Paket::findOrFail($id);
         return view('backend.paket.edit', compact('editData'));
    }
    public function update(Request $request, $id)
    {
     $editData=Paket::find($id);
         $validateData= $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
       
         ]);
      

         $editData->update([
            'nama_paket'=> $request->input('nama_paket'),
            'deskripsi' => $request->input('deskripsi'),
            
         ]);
         return redirect()->route('paket.index')->with('success','Tambah Bahan berhasil');

}
     public function delete($id){
     $paket=Paket::find($id);

     $paket->delete();
    return  redirect()->route('paket.index')->with('success', 'data berhasil di hapus');

}
}
