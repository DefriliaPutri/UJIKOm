@extends('layouts.global')

@section('title') Paket list @endsection

@section('content')


<div class="row">
    <div class="col-md-6">
        <form action="{{route('outlets.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by outlets name"
                    value="{{Request::get('nama')}}" name="nama">
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('pakets.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('pakets.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
</div>
<hr class="my-3">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif


        <div class="row">
            <div class="col-md-12 text-left">
                <a href="{{route('pakets.create')}}" 
                class="btn btn-primary">Tambah Paket</a>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                    <tr>
                        <th><b>Nama</b></th>
                        <th><b>Jenis</b></th>
                        <th><b>Outlets</b></th>
                        <th><b>harga</b></th>
                        <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($paket as $paket1)
                    <tr>
                       
                        <td>{{$paket1->nam_paket}}</td>
                        <td>{{$paket1->jenis}}</td>

                        @foreach($paket1->outlets as $outlet)
                        <td>       
                            {{$outlet->nama}}   
                        </td>
                        @endforeach

                        <td>{{$paket1->harga}}</td>
                            
                        <td>
                            <a href="{{route('pakets.edit', [$paket1->id])}}" class="btn btn-info btn-sm"> Edit </a>
                            <form method="POST" class="d-inline" onsubmit="return confirm('Move book to trash?')"
                                action="{{route('pakets.destroy', [$paket1->id])}}">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method">
                                <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    


@endsection
