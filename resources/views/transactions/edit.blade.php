@extends("layouts.global")
@section("title") Buat Transaksi @endsection
@section("content") 

<div class="col-md-8">

@if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('transaksi.update', [$transaction->id])}}" method="POST">
        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method">
        

        <label for="outlets">Outlets</label>
        <br>
        <select name="outlets"  id="outlets" class="form-control">
        </select>
        <br><br>

        <label for="paket_id">Paket</label>
        <br>
        <select name="paket_id"  id="paket_id" class="form-control">
        @foreach($paket as $pk) 
            <option value="{{$pk->id}}" {{($transaction->paket_id == $pk->id) ? 'selected' : ''}}>{{$pk->nam_paket}}</option>
        @endforeach
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
            value="{{$transaction->tgl}}"
            name="tgl"
            id="tgl">
        <br>

        <label for="batas_waktu">Batas Waktu Pembayaran</label>
        <br>
        <input 
            type="date"
            class="form-control"
            value="{{$transaction->batas_waktu}}"
            name="batas_waktu"
            id="batas_waktu">
        <br>

        <label for="diskon">Diskon</label>
        <br>
        <input 
            type="number"
            class="form-control"
            value="{{$transaction->diskon}}"
            name="diskon"
            id="diskon">
            <p><h6>*masukan dengan nilai rupiah</h6></p>
        <br>

        <label for="pajak">Pajak</label>
        <br>
        <input 
            type="number"
            class="form-control"
            value="{{$transaction->pajak}}"
            name="pajak"
            id="pajak">
            <p><h6>*masukan dengan nilai rupiah</h6></p>
        <br>

        <label for="ket">Keterangan</label><br>
            <select name="ket" id="ket" class="form-control">
                <option value="">pilih...</option>
                <option {{$transaction->ket == 'dibayar' ? 'selected' : ''}} value="dibayar">Sudah di Bayar</option>
                <option {{$transaction->ket == 'blm' ? 'selected' : ''}} value="blm">Belum di Bayar</option>
            </select>
            <br>

        <label for="tgl_byr">Tanggal di Bayar</label>
        <br>
        <input 
            type="date"
            class="form-control"
            value="{{$transaction->tgl_byr}}"
            name="tgl_byr"
            id="tgl_byr">
        <br>

        <label for="biaya_tmbhn">Biaya Tambahan</label>
        <br>
        <input 
            type="number"
            class="form-control"
            name="biaya_tmbhn"
            value="{{$transaction->biaya_tmbhn}}"
            id="biaya_tmbhn">
        <br>

        <label for="status">Satatus</label><br>
            <select name="status" id="status" class="form-control">
                <option value="">pilih...</option>
                <option {{$transaction->status == 'baru' ? 'selected' : ''}} value="baru">Pesanan Baru</option>
                <option {{$transaction->status == 'proses' ? 'selected' : ''}} value="proses">Dalam Pengerjaan</option>
                <option {{$transaction->status == 'selesai' ? 'selected' : ''}} value="selesai">Selesai</option>
                <option {{$transaction->status == 'diambil' ? 'selected' : ''}} value="diambil">Telah di Ambil</option>
                <option {{$transaction->status == 'batal' ? 'selected' : ''}} value="batal">Pesanan diBatalkan</option>
            </select>
            <br>

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>

</div>


@endsection
@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
   

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
    
    var members = {!! $transaction->members !!}

  members.forEach(function (member){
      var option = new Option(member.nama, member.id, true, true);
      $('#members').append(option).trigger('change');
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

    var outlets = {!! $transaction->outlets !!}

  outlets.forEach(function (outlet){
      var option = new Option(outlet.nama, outlet.id, true, true);
      $('#outlets').append(option).trigger('change');
  });
</script>
@endsection