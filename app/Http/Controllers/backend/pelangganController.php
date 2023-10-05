<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class pelangganController extends Controller
{
    public function index(){ 
        $pelanggan = Pelanggan::all();
        return view('admin.pelanggan.index', compact('pelanggan'));
      }
      public function add(){
        return view('admin.pelanggan.add');
    }
    public function store(Request $request){
        $rules=[
          'nama' => 'required',
          'alamat' => 'required',
          'no_telp' => 'required',
         ];
    
           $messages =[
             'nama.required' => '*Nama harus diisi',
             'alamat.required' => '*Dekripsi harus diisi',
             'no_telp.required' => '*nomor Telp harus diisi' 
         ];
    
         $this->validate($request,$rules,$messages);
   
          $pelanggan = new Pelanggan(); 
          $pelanggan->nama=$request->input('nama');
          $pelanggan->alamat=$request->input('alamat');
          $pelanggan->no_telp=$request->no_telp;
        
      
         
          $pelanggan->save();
          return redirect()->route('pelanggan.index')->with('success', 'Banner berhasil ditambahkan');
    
       }
       public function edit(Request $request, $id){
        $editData = Pelanggan::findOrFail($id);
         return view('admin.pelanggan.edit', compact('editData'));
    }
    public function update(Request $request, $id)
    {
     $editData=Pelanggan::find($id);
         $validateData= $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
       
         ]);
      

         $editData->update([
            'nama'=> $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_telp' => $request->input('no_telp'),
            
         ]);
         return redirect()->route('pelanggan.index')->with('success','Tambah Bahan berhasil');

}
       public function delete($id){
        $pelanggan=Pelanggan::find($id);
   
        $pelanggan->delete();
       return  redirect()->route('pelanggan.index')->with('success', 'data berhasil di hapus');
   
   }
}
