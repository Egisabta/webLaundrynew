<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesan;
use App\Models\Pembayaran;
use App\Models\CekStatus;

class cekStatusController extends Controller
{
    public function index(Request $request)
    {
        $pesanData = Pesan::with('pembayarans', 'cek_statuses')->get();
    
        return view('admin.cekStatus.index', compact('pesanData'));
    }

    public function edit($id)
    {
        $cekStatus = CekStatus::find($id);
        return view('admin.cekStatus.edit', compact('cekStatus'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status_laundry' => 'required|in:A,B,C',
            'tanggal_pengambilan' => 'nullable|date_format:Y-m-d',
        ]);

        $cekStatus = CekStatus::find($id);
        if (!$cekStatus) {
            return redirect()->route('cek-status.index')->with('error', 'Data CekStatus tidak ditemukan.');
        }

        $cekStatus->status_laundry = $validatedData['status_laundry'];
        $cekStatus->tanggal_pengambilan = $validatedData['tanggal_pengambilan'];

        $cekStatus->save();

        return redirect()->route('cekStatus.index')->with('success', 'Data CekStatus berhasil diperbarui.');
    }
}

