@extends('layouts.master')
@section('title')
   / {{ trans('messages.category Menu') }}
@stop
@section('css')
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('messages.Setting') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('messages.category Menu') }}</span>
						</div>
					</div>
				</div>
@endsection
@section('content')
				<div class="row">
                    @if($errors->any())
                        <div class="alert alert-danger mx-auto text-center w-100">
                            <ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                        @endif
                    @if(session()->has('add'))
                        <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100" role="alert">
                            <strong class="">{{ session()->get('add') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&time;</span>
                            </button>
                        </div>
                    @endif


                    @if(session()->has('Error'))
                        <div class="alert alert-danger alert-dismissible fade show  mx-auto text-center w-100" role="alert">
                            <strong class="">{{ session()->get('Error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                    @endif



                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ trans('messages.edit category') }}</h6>
                                </div>
                                <form action="{{ route('section.update',$section->id) }}" method="post">
                                    @method('PUT')
                                        @csrf
                                <div class="modal-body">
                                    <input type="hidden" value="{{ $section->id }}" name="id">
                                    <label for="" class="form-group">{{ trans('messages.category name ar') }}</label>
                                    <input type="text" name="section_name_ar" class="form-control" value="{{ $section->section_name_ar }}" >
                                    <label for="" class="form-group">{{ trans('messages.category name en') }}</label>
                                    <input type="text" name="section_name_en" class="form-control" value="{{ $section->section_name_en }}" >


                                    <label for="" class="form-group">{{ trans('messages.category description ar') }}</label>
                                    <textarea  name="description_ar" class="form-control" rows="3"  >value="{{ $section->description_ar }}"</textarea>
                                    <label for="" class="form-group">{{ trans('messages.category description en') }}</label>
                                    <textarea  name="description_en" class="form-control" rows="3"  >value="{{ $section->description_en }}"</textarea>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" type="submit">{{ __('messages.edit category') }}</button>
                                    <a class="btn ripple btn-secondary" href="{{ route('section.index') }}">{{ __('messages.close') }}</a>
                                </div>
                                </form>
                            </div>


		</div>
		</div>
		</div>
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
@endsection

