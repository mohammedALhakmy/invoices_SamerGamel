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
                        <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100 " id="showMessage" role="alert" style="display: none">
                            <strong class=""> {{__('messages.done to add category successfully')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&time;</span>
                            </button>
                        </div>


                        <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100 " id="DeleteMessage" role="alert" style="display: none">
                            <strong class=""> {{__('messages.delete successfully')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&time;</span>
                            </button>
                        </div>


                    @if(session()->has('edit'))
                        <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100" role="alert">
                            <strong class="">{{ session()->get('edit') }}</strong>
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

                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <a class="modal-effect btn btn-outline-primary" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8">{{ trans('messages.add category') }}</a>
                                    </div>
                                 </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ trans('messages.category name') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.description') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.created_by') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.controller') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($section) &&   $section ->count() > 0)
                                                <?php $num = 0 ?>
                                                @forelse($section as $sections)
                                                    <?php $num++; ?>
                                                    <tr class="section_category{{ $sections->id }}">

                                                        <td>{{ $num }}</td>
                                                        <td>{{ $sections->section_name }}</td>
                                                        <td>{{ $sections->description }}</td>
                                                        <td>{{ $sections->created_by }}</td>
                                                        <td>
                                                            <a href="#modaldemoEdit"
                                                               class="fa fa-edit fa-2x text-success modal-effect"
                                                               data-toggle="modal"
                                                               data-effect="effect-scale"
                                                            ></a>
                                                            <a
                                                               class="fa fa-trash text-danger px-3 fa-2x modal-effect confirm"
                                                                data-toggle="modal"
                                                                data-effect="effect-scale" id="delete_section_s"
                                                                attr_delete="{{ $sections->id }}"
                                                            ></a>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <div class="alert alert-info " >{{ __('messages.this the section is empty') }}</div>
                                                    @endforelse
                                            @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <!-- Modal effects -->
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ trans('messages.add category') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form  onsubmit="return false" id="IDaddProductStore">
                                        @csrf
                                <div class="modal-body">
                                    <label for="" class="form-group">{{ trans('messages.category name ar') }}</label>
                                    <input type="text" name="section_name_ar" class="form-control"  >
                                    <small class="form-text text-danger d-block" id="section_name_ar_error"></small>

                                    <label for="" class="form-group">{{ trans('messages.category name en') }}</label>
                                    <input type="text" name="section_name_en" class="form-control"  >
                                    <small class="form-text text-danger d-block" style="display: none" id="section_name_en_error"></small>


                                    <label for="" class="form-group">{{ trans('messages.category description ar') }}</label>
                                    <textarea  name="description_ar" class="form-control" rows="3"  ></textarea>
                                    <small class="form-text text-danger d-block" id="description_ar_error"></small>

                                    <label for="" class="form-group">{{ trans('messages.category description en') }}</label>
                                    <textarea  name="description_en" class="form-control" rows="3"  ></textarea>
                                    <small class="form-text text-danger d-block" id="description_en_error"></small>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" id="save_sections" type="submit">{{ __('messages.add category') }}</button>
                                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('messages.close') }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>



{{--  Edit the modal is this--}}

                        <div class="modal" id="modaldemoEdit">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content modal-content-demo">
                                    <div class="modal-header">
                                        <h6 class="modal-title">{{ trans('messages.add category') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form  onsubmit="return false" id="IDaddProduct">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="" class="form-group">{{ trans('messages.category name ar') }}</label>
                                            <input type="text" name="section_name_ar" class="form-control"  >
                                            <small class="form-text text-danger d-block" id="section_name_ar_error"></small>

                                            <label for="" class="form-group">{{ trans('messages.category name en') }}</label>
                                            <input type="text" name="section_name_en" class="form-control"  >
                                            <small class="form-text text-danger d-block" style="display: none" id="section_name_en_error"></small>


                                            <label for="" class="form-group">{{ trans('messages.category description ar') }}</label>
                                            <textarea  name="description_ar" class="form-control" rows="3"  ></textarea>
                                            <small class="form-text text-danger d-block" id="description_ar_error"></small>

                                            <label for="" class="form-group">{{ trans('messages.category description en') }}</label>
                                            <textarea  name="description_en" class="form-control" rows="3"  ></textarea>
                                            <small class="form-text text-danger d-block" id="description_en_error"></small>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" id="save_sections" type="submit">{{ __('messages.add category') }}</button>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{ __('messages.close') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{--  Edit the modal is this--}}

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
    <script>
        // this is the code is the insert in to the database
        $(document).on('click', '#save_sections', function (e) {
            e.preventDefault();
            $("#section_name_ar_error").text('');
            $("#section_name_en_error").text('');
            $("#description_ar_error").text('');
            $("#description_en_error").text('');
            let IDaddProduct = new FormData($('#IDaddProductStore')[0]);
            $.ajax({
                method:"POST",
                url:"{{ route('section.store')}}",
                processData:false,
                contentType:false,
                cache:false,
                data:IDaddProduct,
                success:function (data){
                    if(data.status === true){
                        $("#showMessage").show();
                         $("input[name='section_name_ar']").val('');
                         $("input[name='section_name_en']").val('');
                         $("input[name='description_ar']").val('');
                         $("input[name='description_en']").val('');
                         window.location.href = '';
                    }
                } ,error: function (reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors,function (key,val){
                        $("#"+key+"_error").text(val[0])
                    });
                }
            });
        });
            //end

        // this is the code is delete the section
        $(document).on('click',"#delete_section_s",function (e){
            e.preventDefault();
            let attr_data =$(this).attr("attr_delete");
            if (confirm("Are You Sure Delete This is Admin Or User ..!?")) {
                $.ajax({
                    type:"post",
                    url:"{{ route('section.destroy') }}",
                    data:{
                        'id':attr_data,
                        '_token':"{{ csrf_token() }}"
                    },
                    success:function (data){
                        if(data.status == true){
                            $("#DeleteMessage").show();
                        }
                        $('.section_category'+data.id).remove();
                    } ,error: function (reject){
                        console.log("success");
                    }
                })
            }
        });
    </script>
@endsection

