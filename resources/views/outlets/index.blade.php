@extends('layouts.global')

@section('title') Outlet list @endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{route('outlets.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by outlet name"
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
                <a class="nav-link active" href="{{route('outlets.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('outlets.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
    </div>

<hr class="my-3">

@if(session('status'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-succsess">
            {{session('status')}}
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-12 text-left">
        <a href="{{route('outlets.create')}}" class="btn btn-primary">Create category</a>
    </div>
</div>
<br>

<div class="row"> 
    <div class="col-md-12">
    
    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No.telpon</th>
                <th>Actions</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($outlets as $outlet)
            <tr>
                <td>{{$outlet->nama}}</td>
                <td>{{$outlet->alamat}}</td>
                <td>{{$outlet->tlp}}</td>
                <td>

                <a href="{{route('outlets.edit', [$outlet->id])}}" class="btn btn-info btn-sm"> Edit </a>

                <form class="d-inline" action="{{route('outlets.destroy', [$outlet->id])}}" 
                     method="POST" onsubmit="return confirm('Move outlet to trash?')">

                @csrf
                <input type="hidden" value="DELETE" name="_method">
                <input type="submit" class="btn btn-danger btn-sm" value="Trash">

                </form>
                
                </td>
            </tr> 
            @endforeach       
        </tbody>
        <tfoot>
            <tr>
                <td colSpan="10">
                {{$outlets->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
    </table>
    </div>
</div>
@endsection