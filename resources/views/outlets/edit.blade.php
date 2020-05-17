@extends('layouts.global')

@section('title')Edit Outlet @endsection

@section('content')

<div class="col-md-8">
    <form 
        action="{{route('outlets.update', [$outlet->id])}}"
        enctyoe="multipart/form-data"
        method="POST"
        class="bg-white shadow-sm p-3">

        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method">  

        <label for="nama">Nama</label>
        <input 
            class="form-control"  
            type="text" 
            name="nama"
            value="{{$outlet->nama}}" />
        <br>

        <label for="alamat">Alamat</label>
        <textarea 
            class="form-control"  
            name="alamat" 
                >{{$outlet->alamat}}</textarea>
        <br>

        <label for="tlp">Nomor Telpon</label>
        <input 
            class="form-control"  
            type="text" 
            name="tlp"
            value="{{$outlet->tlp}}" />
        <br>

        <input class="btn btn-primary" type="submit" value="Update" />  

    </form>
</div>

@endsection