
@extends('layouts.master')
@section('title')
   / {{ trans('messages.product Menu') }}
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
							<h4 class="content-title mb-0 my-auto">{{ __('messages.Setting') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.Products') }}</span>
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
                            <strong class=""> {{__('messages.done to add product successfully')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&time;</span>
                            </button>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100 " id="showEDitMessage" role="alert" style="display: none">
                            <strong class=""> {{__('messages.Edit done to add product successfully')}}</strong>
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
                                        <a class="modal-effect btn btn-outline-primary" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo8">{{ trans('messages.add product') }}</a>
                                    </div>
                                 </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ trans('messages.product name') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.category name') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.description') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.controller') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($products) &&   $products ->count() > 0)
                                                <?php $num = 0;
                                                $any = LaravelLocalization::getCurrentLocale();
                                                ?>
                                                @forelse($products as $product)
                                                    <?php $num++; ?>
                                                    <tr class="section_category{{ $product->id }}">

                                                        <td>{{ $num }}</td>
                                                        <td>{{ $product->product_name }}</td>
                                                       <td>
                                                           {{  (app()->getLocale() === 'en'
                                                            ? $product->section->section_name_en
                                                            : $product->section->section_name_ar) }}
                                                       </td>
                                                        <td>{{ $product->product_description }}</td>
                                                        <td>
                                                            <a
                                                                attr_ID="{{ $product->id }}"
                                                                data-name="{{ $product->product_name }}"
                                                                data-section_name="{{ (app()->getLocale() === 'en' ? $product->section->section_name_en : $product->section->section_name_ar) }}"
                                                                data-description="{{ $product->product_description }}"
                                                                href="#modaldemoEdit"
                                                               class="fa fa-edit fa-2x text-success modal-effect"
                                                               data-toggle="modal"
                                                               data-effect="effect-newspaper"
                                                            ></a>
                                                            <a
                                                               class="fa fa-trash text-danger px-3 fa-2x modal-effect confirm"
                                                                data-toggle="modal"
                                                                data-effect="effect-scale" id="delete_section_s"
                                                                attr_delete="{{ $product->id }}"
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
                                    <h6 class="modal-title">{{ trans('messages.add product') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form  onsubmit="return false" id="IDaddProduct_P">
                                        @csrf
                                <div class="modal-body">
                                    <label for="" class="form-group">{{ trans('messages.product name ar') }}</label>
                                    <input type="text" name="product_name_ar" class="form-control"  >
                                    <small class="form-text text-danger d-block" id="product_name_ar_error"></small>

                                    <label for="" class="form-group">{{ trans('messages.product name en') }}</label>
                                    <input type="text" name="product_name_en" class="form-control"  >
                                    <small class="form-text text-danger d-block" style="display: none" id="product_name_en_error"></small>

                                    <label for="" class="form-group">{{ trans('messages.category name') }}</label>
                                    <select name="section_id" id="section_id" class="form-control">
                                        @if(isset($section) && $section->count() > 0 )
{{--                                            <option>-------{{ trans('messages.select choose') }}-----</option>--}}

                                        @forelse($section as $sections)
                                        <option value="{{ $sections->id }}">{{ $sections->section_name }}</option>
                                                @empty
                                            @endforelse
                                        @endif
                                    </select>
                                    <small class="form-text text-danger d-block" style="display: none" id="section_id_error"></small>


                                    <label for="" class="form-group">{{ trans('messages.product description ar') }}</label>
                                    <textarea  name="product_description_ar" class="form-control" rows="3"  ></textarea>
                                    <small class="form-text text-danger d-block" id="product_description_ar_error"></small>

                                    <label for="" class="form-group">{{ trans('messages.product description en') }}</label>
                                    <textarea  name="product_description_en" class="form-control" rows="3"  ></textarea>
                                    <small class="form-text text-danger d-block" id="product_description_en_error"></small>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn ripple btn-primary" id="save_products" type="submit">{{ __('messages.add product') }}</button>
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
                                        <h6 class="modal-title">{{ trans('messages.edit product') }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                    </div>
{{--                                    <form  action="{{  LaravelLocalization::localizeURL('product/update') }}" id="IDaddProduct_P" method="POST">--}}
                                    <form id="IDProductPOST" onsubmit="returnFalse()">
                                    {{ method_field('PATCH') }}

                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <input type='hidden' name="id" value="id" id="id">
                                            @if(app()->getLocale() === 'ar')
                                            <label for="" class="form-group">{{ trans('messages.edit ') }}{{ trans('messages.product name ar') }}</label>
                                            <input type="text" name="product_name_ar" id="product_name_ar" class="form-control"  >
                                            <small class="form-text text-danger d-block" id="product_name_ar_edit_error"></small>
                                            @else
                                            <label for="" class="form-group">{{ trans('messages.edit ') }} {{ trans('messages.product name en') }}</label>
                                            <input type="text" name="product_name_en" id="product_name_en" class="form-control"  >
                                            <small class="form-text text-danger d-block" style="display: none" id="product_name_en_edit_error"></small>
                                            @endif
                                            <label for="" class="form-group">{{ trans('messages.edit ') }}  {{ trans('messages.category name') }}</label>
                                            <select name="section_id" id="product_section_name" class="form-control">
                                                @if(isset($section) && $section->count() > 0 )
                                                    {{--                                            <option>-------{{ trans('messages.select choose') }}-----</option>--}}

                                                    @forelse($section as $sections)
                                                        <option {{ $sections->id }} >{{ $sections->section_name }}</option>
                                                    @empty
                                                    @endforelse
                                                @endif
                                            </select>
                                            <small class="form-text text-danger d-block" style="display: none" id="section_id_edit_error"></small>

                                            @if(app()->getLocale() === 'ar')
                                            <label for="" class="form-group">{{ trans('messages.edit ') }}  {{ trans('messages.product description ar') }}</label>
                                            <textarea  name="product_description_ar" id="product_description_ar" class="form-control" rows="3"  ></textarea>
                                            <small class="form-text text-danger d-block" id="product_description_ar_edit_error"></small>
                                            @else
                                            <label for="" class="form-group">{{ trans('messages.edit ') }}  {{ trans('messages.product description en') }}</label>
                                            <textarea  name="product_description_en" id="product_description_en" class="form-control" rows="3"  ></textarea>
                                            <small class="form-text text-danger d-block" id="product_description_en_edit_error"></small>
                                            @endif
                                        </div>
                                        {{--  id="save_products"  --}}
                                        <div class="modal-footer">
                                            <button class="btn ripple btn-primary" id="update_products">{{ __('messages.edit product') }}</button>
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
        $(document).on('click', '#save_products', function (e) {
            e.preventDefault();
            $("#product_description_en_error").text('');
            $("#product_description_ar_error").text('');
            $("#product_name_ar_error").text('');
            $("#product_name_en_error").text('');
            $("#section_id_error").text('');

            let IDaddProduct = new FormData($('#IDaddProduct_P')[0]);
            $.ajax({
                method:"POST",
                url:"{{ route('product.store')}}",
                processData:false,
                contentType:false,
                cache:false,
                data:IDaddProduct,
                success:function (data){
                    if(data.status === true){
                        $("#showMessage").show();
                         $("input[name='product_description_en']").val('');
                         $("input[name='product_description_ar']").val('');
                         $("input[name='product_name_ar']").val('');
                         $("input[name='product_name_en']").val('');
                         $("input[name='section_id']").val('');
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
                    url:"{{ route('product.destroy') }}",
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


        // this is the edit the product select the date of the input
        $("#modaldemoEdit").on('show.bs.modal',function (event){
            let  button = $(event.relatedTarget);
            let attr_ID = $(this).attr('attr_ID');
            let product_name =  button.data('name');
            let product_description =  button.data('description');
            let product_section_name =  button.data('section_name');
            let modal = $(this)
            modal.find('.modal-body #product_name_ar').val(product_name);
            modal.find('.modal-body #product_name_en').val(product_name);
            modal.find('.modal-body #product_description_en').val(product_description);
            modal.find('.modal-body #product_description_ar').val(product_description);
            modal.find('.modal-body #product_section_name').val(product_section_name);
            modal.find('.modal-body #id').val(attr_ID);
        })



        $(document).on('click', '#update_products', function (e) {
            e.preventDefault();
            let attr_ID = $(this).attr('attr_ID');
            $("#product_description_en_edit_error").text('');
            $("#product_description_ar_edit_error").text('');
            $("#product_name_ar_edit_error").text('');
            $("#product_name_en_edit_error").text('');
            $("#section_id_edit_error").text('');

            let IDaddProduct = new FormData($('#IDProductPOST')[0]);
            $.ajax({
                method:"POST",
                {{--url:"{{ route('product.update')}}".attr_ID,--}}
                processData:false,
                contentType:false,
                cache:false,
                data:IDaddProduct,
                success:function (data){
                    if(data.status === true){
                        $("#showEDitMessage").show();
                        // window.location.href = '';
                    }
                } ,error: function (reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors,function (key,val){
                        $("#"+key+"_edit_error").text(val[0])
                    });
                }
            });
        });
    </script>
@endsection

