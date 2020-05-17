@extends("layouts.global")
@section("title") Create New User @endsection
@section("content")

@if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif


<div class="col-md-8">
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">
        @csrf

        <label for="name">Name</label>
        <input class="form-control" 
            placeholder="Full Name" 
            type="text" 
            name="name"
             id="name" />
        <br>

        <label for="username">Username</label>
        <input 
            class="form-control"
            placeholder="username" 
            type="text" 
            name="username" id="username" />
        <br>

        <label for="">Roles</label>
        <br>
        <input 
            type="radio"
            name="roles"
            id="admin"
            value="admin"><label for="admin">Administrator</label>

        <input 
            type="radio"
            name="roles"
            id="owner"
            value="owner"><label for="owner">Owner</label>

        <input 
            type="radio"
            name="roles"
            id="kasir"
            value="kasir"><label for="kasir">Kasir</label>
        <br>

        <label for="address">Address</label>
        <textarea
            name="address"
            id="address"
            class="form-control"></textarea>
        <br>

        <label for="outlets">Outlets</label>
        <br>
        <select name="outlets"  id="outlets" class="form-control"></select>
        <br>
            <br><br>

        <label for="avatar">Avatar image</label>
        <br>
        <input
            id="avatar"
            name="avatar"
            type="file"
            class="form-control">
        <br>

        

        <label for="email">Email</label>
        <input
            class="form-control"
            placeholder="user@mail.com"
            type="text"
            name="email"
            id="email"/>
        <br>

        <label for="phone">Phone Number</label>
        <input
            class="form-control"
            placeholder="phone number"
            type="text"
            name="phone"
            id="phone"/>
        <br>

        <label for="password">Password</label>
        <input
            class="form-control"
            placeholder="password"
            type="password"
            name="password"
            id="password"/>
        <br>

        <label for="password_confirmation">Password Confirmation</label>
        <input
            class="form-control"
            placeholder="password confirmation"
            type="password"
            name="password_confirmation"
            id="password_confirmation"/>
        <br>

        <input class="btn btn-primary" type="submit" value="Save" />
    </form>
</div>
@endsection
@section("footer-scripts")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#outlets').select2({
        ajax: {
            url: '/ajax/outlets/search',
            processResults: function (data) {
                return{
                    results: data.map(function (item) {
                        return{
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });
</script>
@endsection
