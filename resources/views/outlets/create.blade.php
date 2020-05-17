@extends("layouts.global")
@section("title") Create New Outlet @endsection
@section("content")
<div class="col-md-8">
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('outlets.store')}}" method="POST">
        @csrf

        <label for="nama">Nama</label>
        <input class="form-control" 
            placeholder="Nama Outlet" 
            type="text" 
            name="nama"
             id="nama" />
        <br>

        <label for="alamat">Alamat</label>
        <textarea 
            class="form-control"  
            name="alamat" 
            id="alamat" ></textarea>
        <br>

        <label for="tlp">Nomor Telpon</label>
        <input class="form-control" 
            placeholder="nomor telpon" 
            type="text" 
            name="tlp"
             id="tlp" />
        <br>

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection