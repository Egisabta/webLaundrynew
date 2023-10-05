<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pesan;
use App\Models\jenisPembayaran; 
use Carbon\Carbon;


class pembayaranController extends Controller
{
    public function add(Request $request)
    {
        $pesananId = $request->query('pesanan_id');
        
     
        $pesanan = Pesan::find($pesananId);
        $jenisPembayaran=jenisPembayaran::all();
    
        $namaPelanggan = $pesanan->pelanggans->nama;
        $totalPembayaran = $pesanan->total_bayar;
        
    
        return view('admin.pembayaran.add', compact('pesananId', 'namaPelanggan', 'totalPembayaran','jenisPembayaran'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pesanan_id' => 'required|exists:pesans,id',
            'metode_pembayaran' => 'required',
            'tanggal_pembayaran' => 'required|date_format:d F Y',
            'status_pembayaran' => 'required|in:Lunas', 
        ]);

        $sudahLunas = Pembayaran::where('pesanan_id', $validatedData['pesanan_id'])->first();

        if ($sudahLunas) {
            return redirect()->back()->with('error', 'Pembayaran untuk pesanan ini sudah ada.');
        }


        $pesanan = Pesan::find($validatedData['pesanan_id']);
        $tanggalPembayaran = Carbon::createFromFormat('d F Y', $request->input('tanggal_pembayaran'));

       
        $pembayaran = new Pembayaran([
            'pesanan_id' => $pesanan->id,
            'status_pembayaran' => $validatedData['status_pembayaran'],
            'metode_pembayaran' => $request->metode_pembayaran, 
            'tanggal_pembayaran' => $tanggalPembayaran->toDateString(),
            'nama_pelanggan' => $pesanan->pelanggans->nama, 
            'total_bayar' => $pesanan->total_bayar, 
        ]);

        $pembayaran->save();

        return redirect()->route('pesanan.index')->with('info', 'Pesan berhasil diperbarui.');
    }
}
