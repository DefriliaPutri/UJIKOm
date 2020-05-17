@extends("layouts.global")
@section("title")List Transaksi @endsection
@section("content")

<hr class="my-3">
@if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('transaksi.create')}}" class="btn btn-primary oi oi-plus">Buat Transaksi</a>

            <a href="{{route('transaksi.laporan')}}" class="btn btn-success oi oi-print">Laporan Transaksi</a>
        </div>
    </div>
        
        <br>
<div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                    <tr>
                        <th><b>Kode Invoice</b></th>
                        <th><b>Outlets</b></th>
                        <th><b>Members</b></th>
                        <th><b>Status</b></th>
                        <th><b>Total</b></th>
                        <td><b>Tanggal</b></td>
                        <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaction as $dt)
                    <tr>
                           <td>{{$dt->kode_invoice}}</td>
                           @foreach($dt->outlets as $outlet)
                            <td>       
                                {{$outlet->nama}}   
                            </td>
                           @endforeach 
                           @foreach($dt->members as $member)
                            <td>       
                                {{$member->nama}}   
                            </td>
                           @endforeach 
                           
                          <td>
                                @if($dt->status == "baru")
                                <span class="badge bg-warning text-light" value="{{$dt->status}}">Pesanan Baru</span>
                                @elseif($dt->status == "proses")
                                <span class="badge bg-info text-light" value="{{$dt->status}}" >Dalam Pengerjaan</span>
                                @elseif($dt->status == "selesai")
                                <span class="badge bg-success text-light"value="{{$dt->status}}" >Selsai</span>
                                @elseif($dt->status == "diambil")
                                <span class="badge bg-dark text-light"value="{{$dt->status}}">Diambil</span>
                                @elseif($dt->status == "batal")
                                <span class="badge bg-danger text-light"value="{{$dt->status}}">Pesanan diBatalkan</span>
                                @endif
                
                          </td>

                           <td>Rp. {{number_format($dt->total,0) }}</td> 
                           <td>
                           {{ date('d F Y',strtotime($dt->tgl)) }}
                            </td>
                           <td>
                                <a href="{{route('transaksi.edit', [$dt->id])}}" class="btn btn-info btn-sm"> Edit </a>
                                <a href="{{route('transaksi.cetakInvoice', [$dt->id])}}" class="btn btn-success btn-sm oi oi-print"> Cetak </a>
                            </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


@endsection