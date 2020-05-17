<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="witsh=device-witsh, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .tb {
        border: 1px solid black;

    }

    .th {
        border: 1px solid black;
        text-align: center;
    }
    
    .tr1 {
        position: absolute;
    }

    .tr2{
        border: 1px solid black
    }
</style>
<body>
        
<div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="th">
                    <tr class="tr1">
                        <th><b>Kode Invoice</b></th>
                        <th><b>Tanggal dibuat</b></th>
                        <th><b>Outlets</b></th>
                        <th><b>Members</b></th>
                        <th><b>Status</b></th>
                        <td><b>diskon</b></td>
                        <td><b>Pajak</b></td>
                        <th><b>Total</b></th>
                        <td><b>Paket</b></td>
                        <th><b>created </b></th>
                        </tr>
                    </thead>
                    <tbody class="tb">
                    @foreach ($transaksi as $ts)
                    <tr class="tr2">
                           <td>{{$ts->kode_invoice}}</td>
                           <td>{{$ts->tgl}}</td>
                           @foreach($ts->outlets as $outlet)
                            <td>       
                                {{$outlet->nama}}   
                            </td>
                           @endforeach 
                           @foreach($ts->members as $member)
                            <td>       
                                {{$member->nama}}   
                            </td>
                           @endforeach 
                           
                          <td>
                            {{$ts->status}}
                          </td>
                        <td>{{$ts->diskon}}</td>
                        <td>{{$ts->pajak}}</td>
                           <td>Rp. {{number_format($ts->total,0) }}</td> 
                           <td>
                            {{$ts->paket_id}}
                            </td>
                           <td>
                              {{$ts->created_by}} 
                            </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>