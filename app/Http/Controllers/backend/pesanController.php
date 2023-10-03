<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Pelanggan;
use App\Models\Paket;

use Carbon\Carbon;

class pesanController extends Controller
{
    public function index (){
        $data['allDataPesanan']=Pesan::with(['pelanggans', 'pakets'])->get();
            return view('admin.pesanan.index', $data);
         }

        //  (['pelanggans', 'pakets'])
       
         public function add(Request $request){
            // $pelanggan =Pelanggan::where('nama','like','%'.$request->id_pelanggan. '%');
            
            $pelanggan=Pelanggan::all();
            $paket=Paket::all();
            return view('admin.pesanan.add',compact('pelanggan','paket',));
         } 
         public function store(Request $request)
         {
           
              
                     $validatedData = $request->validate([
                        'id_pelanggan' => 'required',
                        'id_paket' => 'required',
                        'tgl_pesan' => 'required|date_format:d F Y',
                        'berat' => 'required|numeric',
                        'diskon_persen' => 'nullable|numeric',
                      
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
                        $data->diskon_persen = $request->diskon_persen; 
               
                     $paket = Paket::find($request->id_paket);
                     if ($paket) {
                     $totalBayar = $paket->harga * $request->berat;

                    // Hitung diskon dalam persentase jika ada
                    if ($request->diskon_persen) {
                    $diskonPersen = $request->diskon_persen;
                    $diskonRupiah = ($diskonPersen / 100) * $totalBayar;
                       $totalBayar -= $diskonRupiah;
                    }

                    $data->total_bayar = max(0, $totalBayar); 
                    }
                    $data->save();

                 return redirect()->route('pesanan.index')->with('info', 'Tambah Alat berhasil');
             }  
                 public function edit($id)
              {
                 $pesan = Pesan::find($id);

                 if (!$pesan) {
                 return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak ditemukan.');
                 }

                $pelanggan = Pelanggan::all();
                $paket = Paket::all();

                return view('admin.pesanan.edit', compact('pesan', 'pelanggan', 'paket'));
                }

                public function update(Request $request, $id)
                {
                $pesan = Pesan::find($id);

                 if (!$pesan) {
                return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak ditemukan.');
                 }

                 $validatedData = Validator::make($request->all(), [
                 'id_pelanggan' => 'required',
                 'id_paket' => 'required',
                 'tgl_pesan' => 'required|date_format:d F Y',
                 'berat' => 'required|numeric',
                 'diskon_persen' => 'nullable|numeric',
                 ])->validate();

                 $tanggalPesan = Carbon::createFromFormat('d F Y', $request->input('tgl_pesan'));

    $pesan->id_pelanggan = $request->id_pelanggan;
    $pesan->id_paket = $request->id_paket;
    $pesan->tgl_pesan = $tanggalPesan->toDateString();
    $pesan->berat = $request->berat;
    $pesan->diskon_persen = $request->diskon_persen;

    $paket = Paket::find($request->id_paket);
    if ($paket) {
        $totalBayar = $paket->harga * $request->berat;

        // Hitung diskon dalam persentase jika ada
        if ($request->diskon_persen) {
            $diskonPersen = $request->diskon_persen;
            $diskonRupiah = ($diskonPersen / 100) * $totalBayar;
            $totalBayar -= $diskonRupiah;
        }

        $pesan->total_bayar = max(0, $totalBayar);
    }

    $pesan->save();

    return redirect()->route('pesanan.index')->with('info', 'Pesan berhasil diperbarui.');
}

             public function delete($id)
             {
                 $pesan = Pesan::find($id);
         
                 if (!$pesan) {
                     return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak ditemukan.');
                 }
                 $pesan->delete();
         
                 return redirect()->route('pesanan.index')->with('success', 'Pesanan dan semua pembayaran yang terkait berhasil dihapus.');
             }
         }
             
             
 

