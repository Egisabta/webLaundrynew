<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Pelanggan;
use App\Models\Paket;

use Carbon\Carbon;
use PDF;

class pesanController extends Controller
{
    public function index (){
        $data['allDataPesanan']=Pesan::with(['pelanggans', 'pakets'])->get();
            return view('admin.pesanan.index', $data);
         }

         public function search(Request $request)
         {
             $keyword = $request->input('keyword');
             $data['allDataPesanan'] = Pesan::with(['pelanggans', 'pakets', ])
                 ->where(function ($query) use ($keyword) {
                     $query->whereHas('pelanggans', function ($subQuery) use ($keyword) {
                         $subQuery->where('nama', 'like', '%' . $keyword . '%');
                     })
                     ->orWhereHas('pakets', function ($subQuery) use ($keyword) {
                         $subQuery->where('nama_paket', 'like', '%' . $keyword . '%');
                     });
                     
                 })
               
                 ->get();
         
             $data['keyword'] = $keyword;
         
             return view('admin.pesanan.index', $data);
         }
         
         public function add(Request $request){
            $lastTransaksi = Pesan::latest('kd_transaksi')->first();
            if ($lastTransaksi) {
                $lastNumber = (int) substr($lastTransaksi->kd_transaksi, 10);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $newKodeTransaksi = 'KTRA' . str_pad($newNumber, 10, '9800000001', STR_PAD_LEFT);
            $pelanggan=Pelanggan::all();
            $paket=Paket::all();
            $totalBayar = 0; 

            

            
return view('admin.pesanan.add', compact('pelanggan', 'paket', 'newKodeTransaksi', 'totalBayar'));
}
         public function store(Request $request)
         {
             $validatedData = $request->validate([
                 'kd_pelanggan' => 'required',
                 'kd_paket' => 'required',
                 'tgl_pesan' => 'required|date_format:d F Y',
                 'berat' => 'required|numeric',
                 'diskon_persen' => 'nullable|numeric',
                 'pajak_persen' => 'nullable|numeric',
                 'delivery' => 'boolean|nullable', 
                 'biaya_delivery' => 'nullable|numeric',
                 'total_bayar' =>'numeric',
                 'tgl_pembayaran' =>'nullable|date_format:d F Y',
                 'tgl_pengambilan' =>'nullable|date_format:d F Y',
                 'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
                 'status' => 'nullable|in:Baru,Proses,Diantar,Selesai',
                 'catatan' => 'nullable'
             ], [
                 'kd_pelanggan.required' => 'Nama pelanggan harus diisi',
                 'kd_paket.required' => 'Nama paket harus diisi',
             ]);
         
             $lastTransaksi = Pesan::latest('kd_transaksi')->first();
             if ($lastTransaksi) {
                 $lastNumber = (int) substr($lastTransaksi->kd_transaksi, 4);
                 $newNumber = $lastNumber + 1;
                 $newKodeTransaksi = 'KTRA' . sprintf('%10d', $newNumber);
             } else {
                 $newKodeTransaksi = 'KTRA9800000001';
             }
         
             $tanggalPesan = Carbon::parse($request->input('tgl_pesan'));
         
             $tanggalPembayaran = $request->input('tgl_pembayaran') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pembayaran')) : null;
             $tanggalPengambilan = $request->input('tgl_pengambilan') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pengambilan')) : null;         
             $data = new Pesan();
             $data->kd_transaksi = $newKodeTransaksi;
             $data->kd_pelanggan = $request->kd_pelanggan; 
             $data->kd_paket = $request->kd_paket;
             $data->tgl_pesan = $tanggalPesan->toDateString();
             $data->berat = $request->berat;
             $data->diskon_persen = $request->diskon_persen;
             $data->pajak_persen = $request->pajak_persen;
             $data->delivery = $request->delivery; 
             $data->biaya_delivery = $request->biaya_delivery; 
             $data->total_bayar = $request->total_bayar;
             $data->tgl_pembayaran = $tanggalPembayaran ? $tanggalPembayaran->toDateString() : null;
             $data->tgl_pengambilan = $tanggalPengambilan ? $tanggalPengambilan->toDateString() : null;
             $data->status_pembayaran = $request->status_pembayaran;
            $data->status = $request->input('status', 'Baru');
            $data->catatan = $request->catatan;
            
             

             $paket = Paket::find($request->kd_paket);
             if ($paket) {
                 $totalBayar = $paket->harga * $request->berat;
         
                 if ($request->diskon_persen) {
                     $diskonPersen = $request->diskon_persen;
                     $diskonRupiah = ($diskonPersen / 100) * $totalBayar;
                     $totalBayar -= $diskonRupiah;
                 }
         
                 if ($request->pajak_persen) {
                     $pajakPersen = $request->pajak_persen;
                     $pajakRupiah = ($pajakPersen / 100) * $totalBayar;
                     $totalBayar += $pajakRupiah;
                 }
         
                 if ($request->delivery) {
                     $totalBayar += $request->biaya_delivery;
                 }
         
                 $data->total_bayar = max(0, $totalBayar);
             }
         
             $data->save();
         
             return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
         }

         public function edit($id){
            $lastTransaksi = Pesan::latest('kd_transaksi')->first();
            if ($lastTransaksi) {
                $lastNumber = (int) substr($lastTransaksi->kd_transaksi, 10);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $newKodeTransaksi = 'KTRA' . str_pad($newNumber, 10, '9800000001', STR_PAD_LEFT);
            $pesan = Pesan::find($id);
        
            if (!$pesan) {
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
            }
        
            $pelanggan = Pelanggan::all();
            $paket = Paket::all();
            $totalBayar = 0;
        
            return view('admin.pesanan.edit', compact('pesan', 'pelanggan', 'paket', 'newKodeTransaksi', 'totalBayar'));
        }
        
        public function update(Request $request, $id){
            $validatedData = $request->validate([
                'kd_pelanggan' => 'required',
                'kd_paket' => 'required',
                'tgl_pesan' => 'required|date_format:d F Y',
                'berat' => 'required|numeric',
                'diskon_persen' => 'nullable|numeric',
                'pajak_persen' => 'nullable|numeric',
                'delivery' => 'boolean|nullable',
                'biaya_delivery' => 'nullable|numeric',
                'total_bayar' => 'numeric',
                'tgl_pembayaran' => 'nullable|date_format:d F Y',
                'tgl_pengambilan' => 'nullable|date_format:d F Y',
                'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
                'status' => 'nullable|in:Baru,Proses,Diantar,Selesai',
                'catatan' => 'nullable'
                
            ], [
                'kd_pelanggan.required' => 'Nama pelanggan harus diisi',
                'kd_paket.required' => 'Nama paket harus diisi',
            ]);
        
            $data = Pesan::find($id);
        
            if (!$data) {
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
            }
        
            $tanggalPesan = Carbon::parse($request->input('tgl_pesan'));
            $tanggalPembayaran = $request->input('tgl_pembayaran') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pembayaran')) : null;
            $tanggalPengambilan = $request->input('tgl_pengambilan') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pengambilan')) : null;
        
            $data->kd_pelanggan = $request->kd_pelanggan;
            $data->kd_paket = $request->kd_paket;
            $data->tgl_pesan = $tanggalPesan->toDateString();
            $data->berat = $request->berat;
            $data->diskon_persen = $request->diskon_persen;
            $data->pajak_persen = $request->pajak_persen;
            $data->delivery = $request->delivery;
            $data->biaya_delivery = $request->biaya_delivery;
            $data->total_bayar = $request->total_bayar;
            $data->tgl_pembayaran = $tanggalPembayaran ? $tanggalPembayaran->toDateString() : null;
            $data->tgl_pengambilan = $tanggalPengambilan ? $tanggalPengambilan->toDateString() : null;
            $data->status_pembayaran = $request->status_pembayaran;
            $data->status = $request->input('status');
            $data->catatan = $request->catatan;
        
            $paket = Paket::find($request->kd_paket);
            if ($paket) {
                $totalBayar = $paket->harga * $request->berat;
        
                if ($request->diskon_persen) {
                    $diskonPersen = $request->diskon_persen;
                    $diskonRupiah = ($diskonPersen / 100) * $totalBayar;
                    $totalBayar -= $diskonRupiah;
                }
        
                if ($request->pajak_persen) {
                    $pajakPersen = $request->pajak_persen;
                    $pajakRupiah = ($pajakPersen / 100) * $totalBayar;
                    $totalBayar += $pajakRupiah;
                }
        
                if ($request->delivery) {
                    $totalBayar += $request->biaya_delivery;
                }
        
                $data->total_bayar = max(0, $totalBayar);
            }
        
            $data->save();
        
            return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate.');
        }
        


         public function updateStatus(Request $request, $id){
         $validatedData = $request->validate([
         'status' => 'nullable|in:Baru,Proses,Diantar,Selesai',
          ]);
          $pesan = Pesan::find($id);
          if (!$pesan) {
          return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

          $pesan->status = $request->input('status');
          $pesan->save();

          return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
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

        public function invoice($kdTransaksi){
        $pesanan = Pesan::where('kd_transaksi', $kdTransaksi)->first();

        if (!$pesanan) {
            return abort(404); 
        }
        return view('admin.pesanan.invoice', compact('pesanan'));
    }
}



             
             
             
         
             
             
 