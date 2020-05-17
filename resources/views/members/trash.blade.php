@extends('layouts.global')
@section('title') Trashed Categories @endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <form action="{{route('members.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by members name"
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
                <a class="nav-link" href="{{route('members.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{route('members.trash')}}">Trash</a>
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
                    <th>Jenis Kelamin</th>
                    <th>Telpon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($member as $member)
                <tr>
                    <td>{{$member->nama}}</td>
                    <td>{{$member->alamat}}</td>
                    <td>
                        @if($member->jenis_kelamin == "P")
                        <p value="{{$member->jenis_kelamin}}">Wanita</p>
                        
                        @else($member->jenis_kelamin == "L")
                        <p value="{{$member->jenis_kelamin}}">Pria</p>
                        @endif
                    </td>
                    <td>{{$member->no_telp}}</td>
                    <td>

                        <a href="{{route('members.restore', [$member->id])}}" class="btn btn-success">Restore</a>

                        
                        <form class="d-inline" action="{{route('members.deletepermanent', [$member->id])}}"
                            method="POST" onsubmit="return confirm('Delete this member permanently?')">
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
                       
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
