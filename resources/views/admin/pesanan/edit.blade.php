@extends('backend.master')
@section('backend')

<div class="col-12">
    <div class="card mb-4">
        <div class="card-header"><strong>Edit Pesanan</strong><span class="small ms-1"></span></div>
        <div class="card-body">
            <div class="example">
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                        <form action="{{ route('pesanan.update', $pesan->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <fieldset disabled>
                            <div class="input-group mb-3">
                            <label for="disabledTextInput" class="input-group-text">Kode Transaksi</label>
                            <input type="text" id="disabledTextInput" class="form-control"  name="kd_transaksi" value="{{ $newKodeTransaksi }}">
                            </div>
                            </fieldset>


                           
                            <div class="input-group mb-3">
                                <label for="tgl_pesan" class="input-group-text">Tanggal Pesan</label>
                                <input id="tgl_pesan" type="text" class="form-control" name="tgl_pesan" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $pesan->tgl_pesan)->format('d F Y') }}" required>
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>

                            <div class="form-group mb-3">
                            <select id="pelanggan" name="kd_pelanggan" class="form-control" required>
                                    @foreach ($pelanggan as $pelangganItem)
                                        <option value="{{ $pelangganItem->id }}" {{ $pelangganItem->id == $pesan->kd_pelanggan ? 'selected' : '' }}>
                                            {{ $pelangganItem->nama }} -- {{ $pelangganItem->alamat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <select class="form-select" aria-label="Default select example" name="kd_paket" id="paket">
                                    <option selected disabled>Paket Yang Dipilih</option>
                                    @foreach ($paket as $paketItem)
                                        <option value="{{ $paketItem->id }}" {{ $paketItem->id == $pesan->kd_paket ? 'selected' : '' }}>
                                            {{ $paketItem->nama_paket }} --  Rp.{{ number_format($paketItem->harga, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            
                            <div class="input-group mb-3">
                                <label for="inputField" class="input-group-text">Berat</label>
                                <input class="form-control" type="text" name="berat" id="berat" value="{{ $pesan->berat }}">
                                <span class="input-group-text">/kg</span>
                            </div>

                             <div class="input-group mb-3">
                                <label for="inputField" class="input-group-text">Diskon (%)</label>
                                <input class="form-control" type="number" name="diskon_persen" placeholder="Masukkan apabila memiliki diskon" value="{{ $pesan->diskon_persen }}">
                                <span class="input-group-text">%</span>
                            </div>

                            <div class="input-group mb-3">
                                <label for="inputField" class="input-group-text">Pajak (%)</label>
                                <input class="form-control" type="number" name="pajak_persen" placeholder="Masukkan apabila ada pajak" value="{{ $pesan->pajak_persen }}">
                                <span class="input-group-text">%</span>
                            </div>

                            <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="deliveryCheckbox" name="delivery" value="1" {{ $pesan->delivery ? 'checked' : '' }}>
                            <label class="form-check-label" for="deliveryCheckbox">Diantar?</label>
                            </div>

                            <div class="input-group mb-3" id="biayaDeliveryField" style="display: none;">
                            <label for="biayaDelivery" class="input-group-text">Biaya Pengantaran</label>
                            <input class="form-control" type="text" id="biayaDelivery" name="biaya_delivery" aria-label="Biaya Delivery"  value="{{ $pesan->biaya_delivery }}">
                            <span class="input-group-text"></span>
                             </div> 

                             <!-- <div class="input-group mb-3">
                             <label for="totalBayar" class="input-group-text">Total Bayar</label>
                            <input type="text" id="totalBayar" class="form-control" readonly>
                            <input type="hidden" name="total_bayar" id="totalBayarInput" value="">
                             </div> -->

                             
                             <div class="form-group">
                             <label for="status_pembayaran">-Status Pembayaran</label>
                             <select id="status_pembayaran" name="status_pembayaran" class="form-control" required>
                                    <option value="Belum Lunas" {{ $pesan->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="Lunas" {{ $pesan->status_pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                              </div>

                             <div class="input-group mb-3">
                             <label for="tgl_pembayaran" class="input-group-text">Tanggal Pembayaran</label>
                             <input id="tgl_pembayaran" type="text" class="form-control" name="tgl_pembayaran" 
                             value="{{ $pesan->tgl_pembayaran ? \Carbon\Carbon::createFromFormat('Y-m-d', $pesan->tgl_pembayaran)->format('d F Y') : '' }}">
                             <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>


                              <div class="input-group mb-3">
                             <label for="tgl_pengambilan" class="input-group-text">Tanggal Pengambilan</label>
                              <input id="tgl_pengambilan" type="text" class="form-control" name="tgl_pengambilan" 
                               value="{{ $pesan->tgl_pengambilan ? \Carbon\Carbon::createFromFormat('Y-m-d', $pesan->tgl_pengambilan)->format('d F Y') : '' }}">
                               <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                               </div>

                               
                               <div class="mb-3">
                               <label class="form-label" for="formGroupExampleInput2">-Catatan</label>
                               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="catatan" >{{ $pesan->catatan }}</textarea>
                               </div>



                            <button type="submit" class="btn btn-success" style="float: right;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function formatRupiah(angka) {
    var reverse = angka.toFixed(2).split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return ribuan;
}

// ...

function hitungTotalBayar() {
    const hargaPaket = parseFloat(document.getElementById('paket').options[document.getElementById('paket').selectedIndex].getAttribute('data-harga'));
    const berat = parseFloat(document.getElementById('berat').value);
    const diskonPersen = parseFloat(document.getElementsByName('diskon_persen')[0].value);
    const pajakPersen = parseFloat(document.getElementsByName('pajak_persen')[0].value);
    const biayaDelivery = parseFloat(document.getElementById('biayaDelivery').value);
    let totalBayar = hargaPaket * berat;
    
    if (diskonPersen > 0) {
        totalBayar -= (diskonPersen / 100) * totalBayar;
    }
    
    if (pajakPersen > 0) {
        totalBayar += (pajakPersen / 100) * totalBayar;
    }
    
    if (document.getElementById('deliveryCheckbox').checked && biayaDelivery > 0) {
        totalBayar += biayaDelivery;
    }
    
    if (isNaN(totalBayar)) {
        console.error("Perhitungan total bayar menghasilkan NaN");
        totalBayar = 0; 
    }
    
    document.getElementsByName('total_bayar')[0].value = totalBayar;
    document.getElementById('totalBayar').value = formatRupiah(totalBayar);
}
    document.getElementById('paket').addEventListener('change', hitungTotalBayar);
    document.getElementById('berat').addEventListener('input', hitungTotalBayar);
    document.getElementsByName('diskon_persen')[0].addEventListener('input', hitungTotalBayar);
    document.getElementsByName('pajak_persen')[0].addEventListener('input', hitungTotalBayar);
    document.getElementById('deliveryCheckbox').addEventListener('change', function () { 
        hitungTotalBayar();
    });
    document.getElementById('biayaDelivery').addEventListener('input', hitungTotalBayar);
    
    hitungTotalBayar();
</script> 



@endsection
