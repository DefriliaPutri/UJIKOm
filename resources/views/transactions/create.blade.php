@extends("layouts.global")
@section("title") Buat Transaksi @endsection
@section("content") 

<div class="col-md-12">

@if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('transaksi.store')}}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="outlets">Outlets</label>
                <br>
                <select name="outlets"  id="outlets" class="form-control">
                </select>
                <br><br>

                <label for="paket_id">Paket</label>
                <br>
                <select name="paket_id"  id="pakets" class="form-control">
                </select>
                <br><br>
                
                <label for="members">Members</label>
                <br>
                <select name="members"  id="members" class="form-control">
                </select>
                <br><br>


                <label for="tgl">Tanggal</label>
                    <br>
                    <input 
                        type="date"
                        class="form-control"
                        name="tgl"
                        id="tgl">
                    <br>

                

                    <label for="diskon">Diskon</label>
                    <br>
                    <input 
                        type="number"
                        class="form-control"
                        name="diskon"
                        id="diskon">
                        <p><h6>*masukan dengan nilai rupiah</h6></p>
                    <br>

                    <label for="pajak">Pajak</label>
                    <br>
                    <input 
                        type="number"
                        class="form-control"
                        name="pajak"
                        id="pajak">
                        <p><h6>*masukan dengan nilai rupiah</h6></p>
                    <br>

            </div>

            <div class="form-group col-md-6">

                <label for="batas_waktu">Batas Waktu Pembayaran</label>
                    <br>
                    <input 
                        type="date"
                        class="form-control"
                        name="batas_waktu"
                        id="batas_waktu">
                    <br>

                    <label for="ket">Keterangan</label><br>
                    <select name="ket" id="ket" class="form-control">
                        <option value="">pilih...</option>
                        <option value="dibayar">Sudah di Bayar</option>
                        <option value="blm">Belum di Bayar</option>
                    </select>
                    <br>


                    <label for="tgl_byr">Tanggal di Bayar</label>
                    <br>
                    <input 
                        type="date"
                        class="form-control"
                        name="tgl_byr"
                        id="tgl_byr">
                    <br>

                    <label for="biaya_tmbhn">Biaya Tambahan</label>
                    <br>
                    <input 
                        type="number"
                        class="form-control"
                        name="biaya_tmbhn"
                        id="biaya_tmbhn">
                    <br>

                    <label for="status">Satatus</label><br>
                        <select name="status" id="status" class="form-control">
                            <option value="">pilih...</option>
                            <option value="baru">Pesanan Baru</option>
                            <option value="proses">Dalam Pengerjaan</option>
                            <option value="selesai">Selesai</option>
                            <option value="diambil">Telah di Ambil</option>
                            <option value="batal">Pesanan di Batalkan</option>
                        </select>
                        <br>
            </div>
        </div>
        
    

       

       

       

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>

</div>


@endsection
@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#pakets').select2({
        ajax: {
            url: '/ajax/paket/search',
            processResults: function (data) {
                return{
                    results: data.map(function (item) {
                        return{
                            id: item.id,
                            text: item.nam_paket
                        }
                    })
                }
            }
        }
    });

    $('#members').select2({
        ajax: {
            url: '/ajax/members/search',
            processResults: function (data) {
                return{
                    results: data.map(function (item) {
                        return{
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });
    

    $('#outlets').select2({
        ajax: {
            url: '/ajax/outlets/search',
            processResults: function (data) {
                return{
                    results: data.map(function (item) {
                        return{
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });
</script>
<style>
.vl {
  border-left: 1px solid green;
  height: 500px;
  position: absolute;
  left: 50%;
  margin-left: -3px;
  top: 0;
}
</style>
@endsection