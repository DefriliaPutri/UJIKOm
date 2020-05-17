<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
 
    <div class="row">
        <div class="col-md-6">
           
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Customer</th>
                        <td>:</td>
                        @foreach($transaksi->members as $member)
                            <td>       
                                {{$member->nama}}   
                            </td>
                           @endforeach
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td>{{ date('d F Y H:i:s',strtotime($transaksi->created_at)) }}</td>
                    </tr>
                        <th>Kode Invoice</th>
                        <td>:</td>
                        <td>{{ $transaksi->kode_invoice }}</td>
                    <tr>
                    
                    </tr>
                </tbody>
            </table>
 
        </div>
    </div>
 
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>paket</th>
                        <th>status pesanan</th>
                        <th>Outlet</th>
                        <th>pajak</th>
                        <th>diskon</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $transaksi->paket_id }}</td>
                        <td>{{ $transaksi->ket }}</td>
                        @foreach($transaksi->outlets as $outlet)
                            <td>       
                                {{$outlet->nama}}   
                            </td>
                           @endforeach
                        <td>Rp. {{ number_format($transaksi->pajak,0) }}</td
                        <td>Rp. {{ number_format($transaksi->diskon,0) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4"><b><i>Total</i></b></th>
                        <td><b><i>Rp. {{ number_format($transaksi->total,0) }}</i></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
 
</body>
</html>