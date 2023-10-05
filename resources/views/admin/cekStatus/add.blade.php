@extends('backend.master')
@section('backend')

<div class="col-12">
    <div class="card mb-4">
        <div class="card-header"><strong>Tambah Status Laundry</strong></div>
        <div class="card-body">
            <form action="{{ route('cekStatus.store', ['id' => $pesan->id]) }}" method="post">
                @csrf


                <div class="mb-3">
        <label for="status_laundry" class="form-label">Status Laundry</label>
        <select class="form-select" id="status_laundry" name="status_laundry" required>
            <option value="Belum Selesai" {{ old('status_laundry', $cekStatus ? $cekStatus->status_laundry : '') === 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
            <option value="Selesai" {{ old('status_laundry', $cekStatus ? $cekStatus->status_laundry : '') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="tgl_pengambilan" class="form-label">Tanggal Pengambilan</label>
        <input type="text" class="form-control" id="tgl_pengambilan" name="tgl_pengambilan" value="{{ old('tgl_pengambilan', $cekStatus && $cekStatus->tgl_pengambilan ? \Carbon\Carbon::parse($cekStatus->tgl_pengambilan)->format('d F Y') : '') }}">

    </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
