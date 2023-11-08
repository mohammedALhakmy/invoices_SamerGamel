<?php

namespace App\Http\Controllers;

use App\Models\Invocie;
use App\Models\Invoices_detail;
use App\Models\Invoices_attachmunt;
use App\Models\Product;
use App\Models\section;
use App\Models\User;
use App\Notifications\AddInvoices;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\NoReturn;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Exports\InvocieExport;
use Maatwebsite\Excel\Facades\Excel;
class InvocieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $any = LaravelLocalization::getCurrentLocale();
        $invoices = Invocie::select('id','invoice_number','invoice_Date','due_Date','product','section_id','Amount_collection','Amount_Commission',
                                        'Discount','Rate_Vat','Value_Vat','Total','status','note_'.$any.' as note')->get();
        return  view('Invoices.Index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $any = LaravelLocalization::getCurrentLocale();
        $section = section::all('id','section_name_'.$any . ' as section_name');
        return  view('Invoices.add_invoices',compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $FFP = $request->validate([
            'invoice_number'              => ['required',Rule::unique('invocies','invoice_number')],
            'invoice_Date'                => ['required'],
            'Due_date'                    => ['required'],
            'product'                     => ['required'],
            'section_id'                  => ['required'],
            'Amount_collection'           => ['required'],
            'Amount_Commission'           => ['required'],
            'Discount'                    => ['required'],
            'note_ar'                     => ['required'],
            'note_en'                     => ['required'],
        ]);


        if ($FFP) {

           $invoices = Invocie::create([

            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'due_Date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Rate_Vat' => $request->Rate_VAT,
            'Value_Vat' => $request->Value_VAT,
            'Total' => $request->Total,
            'status' => 2,
            'value_status' => 2,
            'note_ar' => $request->note_ar,
            'note_en' => $request->note_en,
        ]);
            $invoices_id = Invocie::latest()->first()->id;
            Invoices_detail::create([
            'id_invocie' => $invoices_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'status' => 2,
            'value_status' => 2,
            'note_ar' => $request->note_ar,
            'note_en' => $request->note_en,
            'user' => (Auth::user()->name)
        ]);


        if ($request->hasFile('pic')) {
//            $this->validate($request,['pic'=>'required|mimes:pdf|max:1000'],['pic.mimes'=>  'done save :dont save file because nassasory pdf dont save invoices']);
//            $invoices_id = Invocie::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoices_number = $request->invoice_number;

            $attachments = new       Invoices_attachmunt();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoices_number;
            $attachments->created_By = Auth::user()->name;
            $attachments->id_Invoice = $invoices_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoices_number), $imageName);
        }
    }
//        $user = User::first();
//        Notification::send($user, new AddInvoices($invoices_id));
//        $user = User::get();
        $user = User::where('id', '!=',Auth::user()->id)->first();
//          $user = User::find(auth()->user()->id);
        $invoices_id = Invocie::latest()->first();

//        $user->notify(new \App\Notifications\AddInvoicesNotification($invoices_id));
        Notification::send($user, new \App\Notifications\AddInvoicesNotification($invoices_id));

        session()->flash('add','add invoices successfully');
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $invoices = Invocie::onlyTrashed()->get();
        return  view('Invoices.archevs',compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $select = Invocie::findorFail($id);
        $any = LaravelLocalization::getCurrentLocale();
        $select = Invocie::where('id',$id)->first();
        $section = section::all();
        $attach = Invoices_attachmunt::all();
        return  view('Invoices.edit_invoices',compact('select','section','attach'));
    }

    public function editActive($id){
        $select = Invocie::where('id',$id)->first();
        $section = section::all();
        $attach = Invoices_attachmunt::all();
        return  view('Invoices.editActive',compact('select','section','attach'));
    }

    public function updSta($id , Request $request){
       $invoices = Invocie::findOrfail($id);
       if ($request->status === 1){
           $invoices->update([
              'status'           => $request->status,
               'Payment_Date'    => $request->Payment_Date,
           ]);
           Invoices_detail::create([
              'Payment_Date' => $request->Payment_Date,
               'status'     => $request->status,
               'value_status'     => $request->status,
               'id_invocie' => $request->id,
               'invoice_number'       =>  $request->invoice_number,
               'product'       => $request->product,
               'section_id'       => $request->section_id,
               'note_ar'       => $request->note_ar,
               'note_en'       => $request->note_en,
               'user'       => (Auth::user()->name),
           ]);
       }
       else{
           $invoices->update([
               'status'           => $request->status,
               'Payment_Date'    => $request->Payment_Date,
           ]);
           Invoices_detail::create([
               'Payment_Date' => $request->Payment_Date,
               'status'     => $request->status,
               'id_invocie' => $request->id,
               'invoice_number'       =>  $request->invoice_number,
               'product'       => $request->product,
               'section_id'       => $request->section_id,
               'note_ar'       => $request->note_ar,
               'note_en'       => $request->note_en,
               'user'       => (Auth::user()->name),
           ]);
       }
       session()->flash('updateStstus');
       return redirect()->route('Invoices.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invocie  $invocie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
//        dd ($request->all());
        $invoice = Invocie::findOrfail($request->id);
        $invoice->update([
            "invoice_number"         => $request->invoice_number,
            "invoice_Date"           => $request->invoice_Date,
            "due_Date"               => $request->Due_date,
            "section_id"             => $request->section_id,
            "product"                => $request->product,
            "Amount_collection"      => $request->Amount_collection,
            "Amount_Commission"      => $request->Amount_Commission,
            "Discount"               => $request->Discount,
            "Rate_Vat"               => $request->Rate_VAT,
            "Value_Vat"              => $request->Value_VAT,
            "Total"                  => $request->Total,
            "note_ar"                => $request->note_ar,
           "note_en"                  => $request->note_en
        ]);
        session()->flash('update',__('messages.update invoices'));
        return redirect()->route('Invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invocie  $invocie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invocie::where('id',$id)->first();
        // delete with the database this function forceDelete()
//        $invoices->forceDelete();


        $attach= Invoices_attachmunt::where('id_Invoice',$id)->first();
        $id_page= $request->id_page;
        if (!$id_page == 2){
            if (!empty($attach->invoice_number)){
                // this is datete the any some files or images in the dierctory  but no delete the dirctory this
                // Storage::disk('public_uploads')->delete($attach->invoice_number.'/'.$attach->file_name);

                // this is delete directory this
                Storage::disk('public_uploads')->deleteDirectory($attach->invoice_number);
            }

//        $invoices->forceDelete();
            $invoices->forceDelete();


            // this is data with datatable not delete in the database
            //$invoices->Delete();
            session()->flash('delete_invoice');
            return redirect()->back();
        }else{
            $invoices->delete();
            session()->flash('archev_invoice');
            return redirect()->back();
        }



    }
    public function section_invoices($id){
        $any = LaravelLocalization::getCurrentLocale();
        $products = DB::table('products')->where('section_id',$id)->pluck('product_name_'.$any.' as product_nam','id');
//        $products = Product::all('id','product_name_'.$any.' as product_name','section_id')->where('section_id',$id);
        return  json_encode($products);
    }


    public function Arch_upd(Request $request){
//        dd($request);
        $id = $request->invoice_id;

        $filds = Invocie::withTrashed()->where('id',$id)->restore();
//        Storage::disk('public_uploads')->deleteDirectory($filds->invoice_number);
        session()->flash('restore');
        return redirect()->route('Invoices.index');
    }


    public function withTrached(Request $request){
        $invoices = Invocie::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoices');
        return redirect()->route('Invoices.index');
    }

    function Print($id){
        $invoices = Invocie::where('id',$id)->first();
        return view('invoices.Print_invoice',compact('invoices'));
    }


    public function export()
    {
        return Excel::download(new InvocieExport, 'Invocie.xlsx');
    }

    public function MarkAsRead_all(Request $request){
//        dd($request->all());
        $userUnreadNotification = auth()->user()->unreadNotifications;
        if ($userUnreadNotification){
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
