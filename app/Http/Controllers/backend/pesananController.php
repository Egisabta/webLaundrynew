<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Paket;

class pesananController extends Controller
{
    public function index (){
        $pesanan['pesanan']=Pesanan::with('pelanggans')->get();
            return view('backend.pesanan.index', $pesanan);
         }
       
         public function add(Request $request){
            // $pelanggan =Pelanggan::where('nama','like','%'.$request->id_pelanggan. '%');
            
            $pelanggan=Pelanggan::all();
            $paket=Paket::all();
            return view('backend.pesanan.add',compact('pelanggan','paket'));
         }
         public function store(Request $request)
         {
            
             $rules = [
                'id_pelanggan' =>'required',
                'id_paket' => 'required',
                'berat' => 'required',
                'tanggal_masuk' => 'required',
                'tanggal_keluar' => 'required',
              
             ];
    
            $messages = [
                'desa_id.required' => 'Nama Desa wajib dipilih !!',
                'judul.required' => 'Judul wajib diisi !!',
                'gambar.required' => 'gambar wajib diisi !!',
                'content.required' => 'Content Wajib Diisi Min.20 Huruf !!',
            ];
    
             $this->validate($request, $rules, $messages);
    
          
                //gambar potensi
                $fileName = time().'.'.$request->gambar->extension();
                $request->file('gambar')->storeAs('public/potensidesa/gambar/', $fileName);
    
                // content
                $content = $request ['content'];
            
                // Handle gambar summernote
                preg_match_all('/<img[^>]+src="([^"]+)"/', $content, $matches);
                $uploadedImages = $matches[1];
            
                foreach ($uploadedImages as $uploadedImage) {
                    if (strpos($uploadedImage, 'data:image') === 0) {
                       
                        $imageData = substr($uploadedImage, strpos($uploadedImage, ',') + 1);
                        $decodedImage = base64_decode($imageData);
                        $imageName = time() . '_' . Str::random(8) . '.png';
                        Storage::disk('public')->put('potensidesa/konten/' . $imageName, $decodedImage);
            
                      
                        $imageUrl = Storage::url('potensidesa/konten/' . $imageName);
                        $content = str_replace($uploadedImage, $imageUrl, $content);
                    }
                }
                $data = new potensiDesa();
                $data->desa_id=$request->desa_id;
                $data->judul=$request->judul;
                $data->gambar = $fileName;
                $data->content = $content;
                $data->save();
    
                return redirect()->route('potensi.view')->with('success','Data Berhasil Ditambahkan');
    
               
                }
}
