@extends("layouts.global")
@section("title") Create New Member @endsection
@section("content")
<div class="col-md-8">
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('members.store')}}" method="POST">

    @if(session('status'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-succsess">
            {{session('status')}}
        </div>
    </div>
</div>
@endif

        @csrf

        <label for="nama">Nama</label>
        <input class="form-control" 
            placeholder="Nama Member" 
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

        <label for="">Jenis Kelamin</label>
        <br>
        <input 
            type="radio"
            name="jenis_kelamin"
            id="L"
            value="L"><label for="L">Pria</label>

        <input 
            type="radio"
            name="jenis_kelamin"
            id="P"
            value="P"><label for="P">Wanita</label>
        <br><br>

        <label for="no_telp">Nomor Telpon</label>
        <input class="form-control" 
            placeholder="Nomor Telpon" 
            type="text" 
            name="no_telp"
             id="no_telp" />
        <br>

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection