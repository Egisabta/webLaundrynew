<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Pelanggan;
use App\Models\Paket;

use Carbon\Carbon;

class pesanController extends Controller
{
    public function index (){
        $data['allDataPesanan']=Pesan::with(['pelanggans', 'pakets'])->get();
            return view('backend.pesanan.index', $data);
         }

        //  (['pelanggans', 'pakets'])
       
         public function add(Request $request){
            // $pelanggan =Pelanggan::where('nama','like','%'.$request->id_pelanggan. '%');
            
            $pelanggan=Pelanggan::all();
            $paket=Paket::all();
            return view('backend.pesanan.add',compact('pelanggan','paket',));
         } 
         public function store(Request $request)
         {
           
              
                     $validatedData = $request->validate([
                        'id_pelanggan' => 'required',
                        'id_paket' => 'required',
                        'tgl_pesan' => 'required|date_format:d F Y',
                        'berat' => 'required|numeric',
                      
                    ],[
                        'id_pelanggan.required' => 'nama pelanggan harus diisi',
                        'id_paket.required' => 'nama pelanggan harus diisi',
                       
                        ]);
                        $tanggalPesan = Carbon::createFromFormat('d F Y', $request->input('tgl_pesan'));
                      

                        $data = new Pesan();
                        $data->id_pelanggan=$request->id_pelanggan;
                        $data->id_paket=$request->id_paket;
                        $data->tgl_pesan= $tanggalPesan->toDateString();
                        $data->berat= $request->berat;
                      
             
                 $data->save();
                 return redirect()->route('pesanan.index')->with('info', 'Tambah Alat berhasil');
             }   
        
}
