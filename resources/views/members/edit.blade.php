@extends('layouts.global')

@section('title')Edit Outlet @endsection

@section('content')

<div class="col-md-8">
    <form 
        action="{{route('members.update', [$member->id])}}"
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
            value="{{$member->nama}}" />
        <br>

        <label for="alamat">Alamat</label>
        <textarea 
            class="form-control"  
            name="alamat" 
                >{{$member->alamat}}</textarea>
        <br>

        <label for="">Jenis Kelamin</label>
        <br>
        <input {{$member ?? ''->jenis_kelamin == "L" ? "checked" : ""}}
            type="radio"
            name="jenis_kelamin"
            id="L"
            value="L"><label for="L">Pria</label>

        <input {{$member ?? ''->jenis_kelamin == "P" ? "checked" : ""}}
            type="radio"
            name="jenis_kelamin"
            id="P"
            value="P"><label for="P">Wanita</label>
        <br><br>

        <label for="no_telp">Nomor Telpon</label>
        <input class="form-control"  
            type="text" 
            name="no_telp"
            id="no_telp" 
            value="{{$member->no_telp}}"/>
        <br>

        <input class="btn btn-primary" type="submit" value="Update" />  

    </form>
</div>

@endsection