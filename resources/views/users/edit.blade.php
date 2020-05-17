@extends("layouts.global")
@section("title") Create Newpaket1Outlet @endsection
@section("content")
<div class="col-md-8">

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" 
    action="{{route('users.update', [$user->id])}}" method="POST">
        @csrf
        <input 
            type="hidden"
            value="PUT"
            name="_method">
        
            <label for="name">Name</label>
        <input class="form-control" 
            placeholder="Full Name"
            value="{{$user->name}}" 
            type="text" 
            name="name"
             id="name" />
        <br>

        <label for="username">Username</label>
        <input 
            class="form-control"
            placeholder="username" 
            value="{{$user->username}}"
            type="text" 
            name="username" id="username" />
        <br>

        <label for="">Roles</label>
        <br>
        <input 
        {{$user ?? ''->status == "admin" ? "checked" : ""}}
            type="radio"
            name="roles"
            id="admin"
            value="admin"><label for="admin">Administrator</label>

        <input 
        {{$user ?? ''->status == "owner" ? "checked" : ""}}
            type="radio"
            name="roles"
            id="owner"
            value="owner"><label for="owner">Owner</label>

        <input 
        {{$user ?? ''->status == "kasir" ? "checked" : ""}}
            type="radio"
            name="roles"
            id="kasir"
            value="kasir"><label for="kasir">Kasir</label>
        <br>

        <label for="address">Address</label>
        <textarea
            name="address"
            id="address"
            class="form-control">{{$user->address}}</textarea>
        <br>

        <label for="outlets">Outlets</label>
        <br>
        <select name="outlets"  id="outlets" class="form-control"></select>
            <br> 

            <label for="avatar">Avatar image</label>
        <br>
        Current avatar: <br>
        @if($user ?? ''->avatar)
        <img src="{{asset('storage/'.$user ?? ''->avatar)}}" width="120px" />
        <br>
        @else
        No avatar
        @endif
        <br>
        <input id="avatar" name="avatar" type="file" class="form-control">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah
            avatar</small>
        <hr class="my-4">

        

        <label for="email">Email</label>
        <input
            class="form-control"
            placeholder="user@mail.com"
            type="text"
            value="{{$user->email}}"
            name="email"
            id="email"/>
        <br>

        <label for="phone">Phone Number</label>
        <input
            class="form-control"
            placeholder="phone number"
            value="{{$user->phone}}"
            type="text"
            name="phone"
            id="phone"/>
        <br>

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
  var outlets = {!! $user->outlets !!}

  outlets.forEach(function (outlet){
      var option = new Option(outlet.nama, outlet.id, true, true);
      $('#outlets').append(option).trigger('change');
  });



</script>
@endsection