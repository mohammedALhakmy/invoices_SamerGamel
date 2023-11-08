<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class SectionController extends Controller
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
        $section = section::select('id',
                                    'section_name_'.$any. ' as section_name',
                                    'description_'.$any. ' as description',
                                    'created_by')->get();
            return view('category.Index',compact('section'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
           $request->validate([
            'section_name_ar' => 'required|unique:sections|max:999',
            'section_name_en' => 'required|unique:sections|max:999',
            'description_ar' => 'required',
            'description_en' => 'required',
            ],[
            'section_name_en.required' => __('messages.required en'),
            'section_name_ar.required' => __('messages.required ar'),
            'description_en.required' => __('messages.description_en en'),
            'description_ar.required' => __('messages.description_ar ar'),

        ]);
          $section = section::create([
            'section_name_en' => $request->section_name_en,
            'section_name_ar' => $request->section_name_ar,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'created_by' => (Auth::user()->name),
        ]);
        if ($section){
            return  response()->json([
                'status' => true,
                'msg' => 'تم الخفظ'
            ]);
        }else{
            return  response()->json([
                'status' => false,
                'msg' => 'Error'
            ]);
        }
    }

    public function show()
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit( $id)
    {
        $edits = section::find($id);
        if (!$edits)
            return response()->json([
                'status' => false,
                'msg' => 'This is the ID is Not Found '
            ]);
        $edits = section::select('id','name_ar','name_en','details_ar','details_en','price','photo')->find($id->id);
        return  view('category.Index',compact('edits'));
//        $section = section::findOrFail($id);
//        if ($section){
//            return view('category.edit',compact('section'));
//        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $any = LaravelLocalization::getCurrentLocale();
        $section = section::findOrFail($id);
        if (!$section){
            return abort('404');
        }else{
            $this->validate($request,[
            'section_name_'.$any => 'required|max:999|unique:sections,section_name_'.$any.','.$id,
                'description_en' => 'required',
                'description_ar' => 'required',
                ],
                [
                    'section_name_en.required' => __('messages.required en'),
                    'section_name_ar.required' => __('messages.required ar'),
                    'description_en.required' => __('messages.description_en en'),
                    'description_ar.required' => __('messages.description_ar ar'),
                ]);
            $section->update([
                'section_name_ar' => $request->section_name_ar,
                'section_name_en' => $request->section_name_en,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar
            ]);
            session()->flash('edit',__('messages.successFully is Edit'));
            return  redirect()->route('section.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Request
     */
    public function destroy(Request $request)
    {
        //
       /* $ids = section::find($id);
        $ids->delete();
        session()->flash('delete',__('messages.delete successfully'));
        return redirect('/');*/
        $section = section::find($request->id);
        if (!$section)
            return redirect()->back();
        $section->delete();
        return response()->json([
            'status' => true,
            'msg' => 'SuccessFully Deleted',
            'id' =>$section->id
        ]);
    }
}
