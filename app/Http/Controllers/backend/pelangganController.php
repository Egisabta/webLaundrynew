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
      public function add()
      {
          $lastPelanggan = Pelanggan::latest('kd_pelanggan')->first();
          if ($lastPelanggan) {
              $lastNumber = (int) substr($lastPelanggan->kd_pelanggan, 4);
              $newNumber = $lastNumber + 1;
          } else {
              $newNumber = 1;
          }
          $newKodePelanggan = 'KPP' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

          
  
      
          return view('admin.pelanggan.add', compact('newKodePelanggan'));
      }
      
    public function store(Request $request) {
      $rules = [
          'nama' => 'required',
          'alamat' => 'required',
          'no_telp' => 'required',
      ];
  
      $messages = [
          'nama.required' => '*Nama harus diisi',
          'alamat.required' => '*Deskripsi harus diisi',
          'no_telp.required' => '*Nomor Telp harus diisi'
      ];
  
      $this->validate($request, $rules, $messages);
  

      $lastPelanggan = Pelanggan::latest('kd_pelanggan')->first();
      if ($lastPelanggan) {
          $lastNumber = (int)substr($lastPelanggan->kd_pelanggan, 4);
          $newNumber = $lastNumber + 1;
          $newKodePelanggan = 'KPP' . sprintf('%4d', $newNumber);
      } else {
          $newKodePelanggan = 'KPP0001';
      }
  
      $pelanggan = new Pelanggan();
      $pelanggan->kd_pelanggan = $newKodePelanggan;
      $pelanggan->nama = $request->input('nama');
      $pelanggan->alamat = $request->input('alamat');
      $pelanggan->no_telp = $request->input('no_telp');
  
      $pelanggan->save();
      return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan');
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