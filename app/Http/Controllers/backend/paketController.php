<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;

class paketController extends Controller
{
    public function index(){ 
         $paket = Paket::all();
         return view('admin.paket.index', compact('paket'));
       }

    public function add(){
      $lastPaket = Paket::latest('kd_paket')->first();
      if ($lastPaket) {
          $lastNumber = (int) substr($lastPaket->kd_paket, 3);
          $newNumber = $lastNumber + 1;
      } else {
          $newNumber = 1;
      }
      $newKodePaket = 'KPA' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return view('admin.paket.add', compact('newKodePaket'));
    }

    public function store(Request $request){
     $rules=[
       'nama_paket' => 'required|unique:pakets',
       'deskripsi' => 'required',
       'harga' => 'required|numeric',
      ];
 
        $messages =[
          'nama_paket.required' => '*Nama paket harus diisi',
          'nama_paket.unique' => '*Nama paket Sudah Ada',
          'deskripsi.required' => '*Dekripsi harus diisi',
          'harga.required' => '*harga harus diisi' 
      ];
 
      $this->validate($request,$rules,$messages);
      //  $x = (float) $request->input('harga');

      $lastPaket = Paket::latest('kd_paket')->first();
      if ($lastPaket) {
          $lastNumber = (int)substr($lastPaket->kd_paket, 3);
          $newNumber = $lastNumber + 1;
          $newKodePaket = 'KPA' . sprintf('%03d', $newNumber); // Ubah menjadi 'KPA' dan tambahkan 3 digit
      } else {
          $newKodePaket = 'KPA001';
      }

       $paket = new Paket(); 
       $paket->kd_paket = $newKodePaket;
       $paket->nama_paket=$request->input('nama_paket');
       $paket->deskripsi=$request->input('deskripsi');
       $paket->harga=$request->input('harga');

      //  $paket->harga = $x;
   
      
       $paket->save();
       return redirect()->route('paket.index')->with('success', 'Banner berhasil ditambahkan');
 
    }
    public function edit(Request $request, $id){
        $editData = Paket::findOrFail($id);
         return view('admin.paket.edit', compact('editData'));
    }
    public function update(Request $request, $id)
    {
     $editData=Paket::find($id);
         $validateData= $request->validate([
            'nama_paket' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
       
         ]);
      

         $editData->update([
            'nama_paket'=> $request->input('nama_paket'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            
         ]);
         return redirect()->route('paket.index')->with('success','Tambah Bahan berhasil');

}
     public function delete($id){
     $paket=Paket::find($id);

     $paket->delete();
    return  redirect()->route('paket.index')->with('success', 'data berhasil di hapus');

}
}
