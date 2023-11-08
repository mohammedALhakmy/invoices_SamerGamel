<?php

namespace App\Http\Controllers;

use App\Models\Invocie;
use App\Models\Invoices_attachmunt;
use Illuminate\Http\Request;

class IvoicesAttachmuntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Invoice_Paid
    public function index()
    {
        //
        $invoices = Invocie::where('status',1)->get();
        return view('Invoices.Invoice_Paid',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Invoice_UpPaid
    public function create()
    {
        //
        $invoices = Invocie::where('status',2)->get();
        return view('Invoices.Invoice_UpPaid',compact('invoices'));
    }

    //Invoice_Partial
    public function store()
    {
        //
        $invoices = Invocie::where('status',3)->get();
        return view('Invoices.Invoice_Partial',compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_attachmunt  $ivoices_attachmunt
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_attachmunt $ivoices_attachmunt)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_attachmunt  $ivoices_attachmunt
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_attachmunt $ivoices_attachmunt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_attachmunt  $ivoices_attachmunt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_attachmunt $ivoices_attachmunt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_attachmunt  $ivoices_attachmunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoices_attachmunt $ivoices_attachmunt)
    {
        //
    }
}
