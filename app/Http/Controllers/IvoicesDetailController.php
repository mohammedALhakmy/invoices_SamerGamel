<?php

namespace App\Http\Controllers;

use App\Models\Invocie;
use App\Models\Invoices_attachmunt;
use App\Models\Invoices_detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;
class IvoicesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $select = Invoices_attachmunt::all('file_name','id');
//        if ($select->file_name != $request->file_name){
        $this->validate($request,[
            'file_name' => 'mimes:pdf,png,jpg,jpeg',
        ]);
        $img = $request->file('file_name');
        $file_name = $img->getClientOriginalName();

        $attach = new  Invoices_attachmunt();
        $attach->file_name=$file_name;
        $attach->invoice_number = $request->invoice_number;
        $attach->id_Invoice  = $request->invoice_id;
        $attach->created_By = Auth()->user()->name;
        $attach->save();

        $imgName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'.$request->invoice_number),$imgName);

        session()->flash('addInvoices',__('messages.add invoices successfully'));
        return  back();
//    }
//else{
//    return  'false';
//    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_detail  $ivoices_detail
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show($invoice_number,$file_name)
    {
        //

        /*$files = Storage::disk('public_uploads')->getDriver()
            ->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);*/


        /*$st = "Attachments";
        $pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->file($pathToFile);*/


         $proFix=Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
         return  response()->file($proFix);
    }

    public function download($invoice_number,$file_name){
        $con = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        return response()->download($con);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_detail  $ivoices_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_detail $ivoices_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_detail  $ivoices_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_detail $ivoices_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_detail  $ivoices_detail
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        //
        $invoices = Invoices_attachmunt::findOrfail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete',__('messages.deleted successFully Yeah'));
        return  back();

    }
    public function Details($id){
//        $invoices = Invocie::findOrfail($id);
        $invoices = Invocie::where('id',$id)->first();
//        dd($invoices->invoice_number);
//        $id_umb = $invoices->invoice_number;
//        $details = Invoices_detail::where('invoice_number',$id_umb)->get();
//        $attach = Invoices_attachmunt::where('invoice_number',$id_umb)->get();
        $details = Invoices_detail::where('id_invocie',$id)->get();
        $attach = Invoices_attachmunt::where('id_Invoice',$id)->get();
//        return $details.$invoices.$attach;
        $notification = auth()->user()->notifications()->where('id',$id)->first();

        if ($notification) {
            $notification->markAsRead();
//            return redirect($notification->data['link']);
            return view('invoices_attach.tabs',compact('invoices','details','attach'));
        }
    }
}
