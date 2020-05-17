@extends('layouts.global')
@section('title') Trashed Categories @endsection
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
                <a class="nav-link" href="{{route('outlets.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('outlets.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
</div>
<hr class="my-3">
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($outlets as $outlet)
                <tr>
                    <td>{{$outlet->nama}}</td>
                    <td>{{$outlet->alamat}}</td>
                    <td>{{$outlet->tlp}}</td>
                    <td>

                        <a href="{{route('outlets.restore', [$outlet->id])}}" class="btn btn-success">Restore</a>

                        <form class="d-inline" action="{{route('outlets.deletepermanent', [$outlet->id])}}"
                            method="POST" onsubmit="return confirm('Delete this outlet permanently?')">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE" />

                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
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
