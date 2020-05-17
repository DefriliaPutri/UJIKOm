@extends("layouts.global")
@section("title") Create Newpaket1Outlet @endsection
@section("content")
<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('pakets.update', [$pakets->id])}}" method="POST">
        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method"> 

        <label for="nama">Nama</label>
        <input class="form-control" 
            value="{{$pakets->nam_paket}}" 
            type="text" 
            name="nam_paket"
             id="nam_paket" />
        <br>

        <label for="outlets">Outlets</label>
        <br>
        <select name="outlets" id="outlets" class="form-control md-8"></select>
        <br>
        <br>

        <label for="jenis">Jenis paket</label><br>
            <select name="jenis" id="jenis" class="form-control" >
                <option value="">pilih...</option>
                <option {{$pakets->jenis == 'selimut' ? 'selected' : ''}} value="selimut">Selimut</option>
                <option {{$pakets->jenis == 'bed_cover' ? 'selected' : ''}} value="bed_cover">Bed Cover</option>
                <option {{$pakets->jenis == 'kaos' ? 'selected' : ''}} value="kaos">Kaos</option>
                <option {{$pakets->jenis == 'lain-lain' ? 'selected' : ''}} value="lain-lain">lain lain</option>
            </select>
            <br>

            <label for="harga">Harga</label><br>
                <input type="number" id="harga" name="harga" class="form-control" value="{{$pakets->harga}}">
            <br><br>

        <input class="btn btn-primary" type="submit" value="Update" />
    </form>
</div>
@endsection
@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-
rc.0/js/select2.min.js"></script>
<script>
    $('#outlets').select2({
        ajax: {
            url: '/ajax/outlets/search',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });
  var outlets = {!! $pakets->outlets !!}

  outlets.forEach(function (outlet){
      var option = new Option(outlet.nama, outlet.id, true, true);
      $('#outlets').append(option).trigger('change');
  });



</script>
@endsection