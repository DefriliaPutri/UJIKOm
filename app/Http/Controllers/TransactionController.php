<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Paket;
use App\Member;
use App\Transaction;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = \App\Transaction::paginate(10);
        return view('transactions.index', ['transaction' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = Outlet::orderBy('nama', 'asc')->get();
        $paket = Paket::orderBy('nam_paket', 'asc')->get();
        $member = Member::orderBy('nama', 'asc')->get();


        return view("transactions.create", compact('outlet', 'paket', 'member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new \App\Transaction;
        $data['tgl'] = $request->tgl;
        $data['batas_waktu'] = $request->batas_waktu;
        $data['paket_id'] = $request->paket_id;
        $data['diskon'] = $request->diskon;
        $data['pajak'] = $request->pajak;
        $data['ket'] = $request->ket;
        $data['tgl_byr'] = $request->tgl_byr;
        $data['biaya_tmbhn'] = $request->biaya_tmbhn;
        $data['status'] = $request->status;

        $harga = Paket::find($request->paket_id);
        $harga_paket = $harga->harga;
        $pajak = $request->pajak;
        $tmbhn = $request->biaya_tmbhn;
        $dskn = $request->diskon;
        $grand_total = $harga_paket + $pajak + $tmbhn - $dskn;

        $data['total'] = $grand_total;
        $data['created_by'] = \Auth::user()->id;
        
        $data->save();

        
        $data->outlets()->attach($request->get('outlets'));
       
        $data->members()->attach($request->get('members'));

        return redirect()->route('transaksi.index')->with('status', 'User successfully created');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = \App\Transaction::findOrFail($id);
        $paket = Paket::orderBy('nam_paket', 'asc')->get();
        return view('transactions.edit', compact('transaction', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  \App\Transaction::findOrFail($id);
        $data['tgl'] = $request->tgl;
        $data['batas_waktu'] = $request->batas_waktu;
        $data['paket_id'] = $request->paket_id;
        $data['diskon'] = $request->diskon;
        $data['pajak'] = $request->pajak;
        $data['ket'] = $request->ket;
        $data['tgl_byr'] = $request->tgl_byr;
        $data['biaya_tmbhn'] = $request->biaya_tmbhn;
        $data['status'] = $request->status;

        $harga = Paket::find($request->paket_id);
        $harga_paket = $harga->harga;
        $pajak = $request->pajak;
        $tmbhn = $request->biaya_tmbhn;
        $dskn = $request->diskon;
        $grand_total = $harga_paket + $pajak + $tmbhn - $dskn;

        $data['total'] = $grand_total;
        $data['created_by'] = \Auth::user()->id;
        
        $data->save();

        
        $data->outlets()->sync($request->get('outlets'));
       
        $data->members()->sync($request->get('members'));

        return redirect()->route('transaksi.index')->with('status', 'User successfully created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function laporan()
    {
      
      $transaksi = \App\Transaction::get();
     
      $pdf = PDF::loadView('pdf.laporantransaksi', ['transaksi' =>$transaksi]); 
      return $pdf->stream('laporantransaksi.pdf');
    }

    public function cetakInvoice($id)
    {
      
      $transaksi = \App\Transaction::findOrFail($id);
     
      $pdf = PDF::loadView('pdf.invoice', ['transaksi' =>$transaksi]); 
      return $pdf->stream('invoice.pdf');
    }
}
