<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Pembayaran;
use App\Models\CekStatus;
use Carbon\Carbon;

class cekStatusController extends Controller
{
    public function index(Request $request)
    {
        $pesanData = Pesan::with('pembayarans', 'cek_statuses')->get();
    
        return view('admin.cekStatus.index', compact('pesanData'));
    }
    public function add(Request $request, $id)
{
    $pesan = Pesan::find($id);

    if (!$pesan) {
        return redirect()->route('cekStatus.index')->with('error', 'Pesan tidak ditemukan.');
    }

    $cekStatus = CekStatus::where('id_pemesan', $pesan->id)->first();

    return view('admin.cekStatus.add', compact('pesan', 'cekStatus'));
}


//     public function store(Request $request, $id)
//     {
//         $pesan = Pesan::find($id);
    
//         if (!$pesan) {
//             return redirect()->route('cekStatus.index')->with('error', 'Pesan tidak ditemukan.');
//         }
    
//         $validatedData = $request->validate([
//             'status_laundry' => 'required|in:Belum Selesai,Selesai',
//             'tgl_pengambilan' => 'nullable|date_format:d F Y',
            
//         ]);

//         $tanggalPengambilan = $request->input('tgl_pengambilan') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pengambilan')) : null;
        
//         $existingCekStatus = CekStatus::where('id_pemesan', $pesan->id)->first();

// if ($existingCekStatus) {
//     return redirect()->route('cekStatus.index')->with('error', 'Data status laundry sudah ada.');
// }

        
    
//         $cekStatus = new CekStatus([
//             'id_pemesan' => $pesan->id,
//             'id_tglPesan' => $pesan->tgl_pesan,
//             'status_pembayaran' => $pesan->pembayarans->isEmpty() ? 'Belum Bayar' : $pesan->pembayarans->first()->status_pembayaran,
//             'tgl_pembayaran' => $pesan->pembayarans->isNotEmpty() ? $pesan->pembayarans->first()->tgl_pembayaran : null,
//             'status_laundry' => $validatedData['status_laundry'],
//             'tgl_pengambilan' => $tanggalPengambilan ? $tanggalPengambilan->toDateString() : null,

            
//         ]);
    
//         $cekStatus->save();
    
//         return redirect()->route('cekStatus.index')->with('success', 'Data Status Laundry berhasil ditambahkan.');
//     }
   

public function store(Request $request, $id)
{
    $pesan = Pesan::find($id);

    if (!$pesan) {
        return redirect()->route('cekStatus.index')->with('error', 'Pesan tidak ditemukan.');
    }

    $tanggalPengambilan = $request->input('tgl_pengambilan') ? Carbon::createFromFormat('d F Y', $request->input('tgl_pengambilan')) : null;

    $validatedData = $request->validate([
        'status_laundry' => 'required|in:Belum Selesai,Selesai',
        'tgl_pengambilan' => 'nullable|date_format:d F Y',
    ]);

    $existingCekStatus = CekStatus::where('id_pemesan', $pesan->id)->first();

    if ($existingCekStatus) {
        // Data status laundry sudah ada, maka perbarui data tersebut
        $existingCekStatus->update([
            'status_laundry' => $validatedData['status_laundry'],
            'tgl_pengambilan' => $tanggalPengambilan ? $tanggalPengambilan->toDateString() : null,
        ]);

        return redirect()->route('cekStatus.index')->with('success', 'Data Status Laundry berhasil diperbarui.');
    }

    // Jika data status laundry belum ada, maka tambahkan data baru
    $cekStatus = new CekStatus([
        'id_pemesan' => $pesan->id,
        'id_tglPesan' => $pesan->tgl_pesan,
        'status_pembayaran' => $pesan->pembayarans->isEmpty() ? 'Belum Bayar' : $pesan->pembayarans->first()->status_pembayaran,
        'tgl_pembayaran' => $pesan->pembayarans->isNotEmpty() ? $pesan->pembayarans->first()->tgl_pembayaran : null,
        'status_laundry' => $validatedData['status_laundry'],
        'tgl_pengambilan' => $tanggalPengambilan ? $tanggalPengambilan->toDateString() : null,
    ]);

    $cekStatus->save();

    return redirect()->route('cekStatus.index')->with('success', 'Data Status Laundry berhasil ditambahkan.');
}



}
