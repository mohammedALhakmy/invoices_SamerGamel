@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tabs</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">

					<div class="col-xl-12">

                        <div class="col-xl-12">
                            <!-- div -->
                            <div class="card mg-b-20" id="tabs-style2">
                                <div class="card-body">
                                    <h2 class="mg-b-20">{{ __('messages.inforamtion invoices') }}.</h2>
                                    @if(session()->has('delete'))
                                        <div class="text-danger text ">
                                            <strong> {{ session()->get('delete') }}</strong>
                                        </div>
                                    @endif
                                    @if(session()->has('addInvoices'))
                                        <div class="text-warning text">
                                            <strong>{{ session()->get('addInvoices') }}</strong>
                                        </div>
                                    @endif
                                    <div class="text-wrap">
                                        <div class="example">
                                            <div class="panel panel-primary tabs-style-2">
                                                <div class=" tab-menu-heading">
                                                    <div class="tabs-menu1">
                                                        <!-- Tabs -->
                                                        <ul class="nav panel-tabs main-nav-line">
                                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">{{ __('messages.inforamtion invoices') }}</a></li>
                                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">{{ __('messages.status buy') }}</a></li>
                                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">{{ __('messages.next invoices') }}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab4">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped" style="text-align:center">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th scope="row">رقم الفاتورة</th>
                                                                            <td>{{ $invoices->invoice_number }}</td>
                                                                            <th scope="row">تاريخ الاصدار</th>
                                                                            <td>{{ $invoices->invoice_Date }}</td>
                                                                            <th scope="row">تاريخ الاستحقاق</th>
                                                                            <td>{{ $invoices->due_Date }}</td>
                                                                            <th scope="row">القسم</th>
                                                                            <td>
                                                                                {{ app()->getLocale() === 'en' ? $invoices->section->section_name_en :  $invoices->section->section_name_ar}}
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th scope="row">المنتج</th>
                                                                            <td>{{ $invoices->product }}</td>
                                                                            <th scope="row">مبلغ التحصيل</th>
                                                                            <td>{{ $invoices->Amount_collection }}</td>
                                                                            <th scope="row">مبلغ العمولة</th>
                                                                            <td>{{ $invoices->Amount_Commission }}</td>
                                                                            <th scope="row">الخصم</th>
                                                                            <td>{{ $invoices->Discount }}</td>
                                                                        </tr>


                                                                        <tr>
                                                                            <th scope="row">نسبة الضريبة</th>
                                                                            <td>{{ $invoices->Rate_Vat }}</td>
                                                                            <th scope="row">قيمة الضريبة</th>
                                                                            <td>{{ $invoices->Value_Vat }}</td>
                                                                            <th scope="row">الاجمالي مع الضريبة</th>
                                                                            <td>{{ $invoices->Total }}</td>
                                                                            <th scope="row">الحالة الحالية</th>

                                                                            @if ($invoices->status == 1)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-success">{{ __('messages.good buy')  }}</span>
                                                                                </td>
                                                                            @elseif($invoices->status == 2)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-danger">{{ __('messages.not buy')  }}</span>
                                                                                </td>
                                                                            @else
                                                                                <td><span
                                                                                        class="badge badge-pill badge-warning">{{__('messages.par buy')}}</span>
                                                                                </td>
                                                                            @endif
                                                                        </tr>

                                                                        <tr>
                                                                            <th scope="row" >ملاحظات</th>
                                                                            <td colspan="7"> {{ app()->getLocale() === 'en' ? $invoices->note_en :  $invoices->note_ar}}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        <div class="tab-pane" id="tab5">
                                                            <div class="table-responsive mt-15">
                                                                <table class="table center-aligned-table mb-0 table-hover"
                                                                       style="text-align:center">
                                                                    <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>رقم الفاتورة</th>
                                                                        <th>نوع المنتج</th>
                                                                        <th>القسم</th>
                                                                        <th>حالة الدفع</th>
                                                                        <th>تاريخ الدفع </th>
                                                                        <th>ملاحظات</th>
                                                                        <th>تاريخ الاضافة </th>
                                                                        <th>المستخدم</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($details as $x)
                                                                        <?php $i++; ?>
                                                                        <tr>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $x->invoice_number }}</td>
                                                                            <td>{{ $x->product }}</td>
                                                                        <td>
                                                                            {{ app()->getLocale() === 'en' ? $invoices->section->section_name_en :  $invoices->section->section_name_ar}}
                                                                        </td>
                                                                            @if ($x->status == 1)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-success">{{ __('messages.good buy')  }}</span>
                                                                                </td>
                                                                            @elseif($x->status == 2)
                                                                                <td><span
                                                                                        class="badge badge-pill badge-danger">{{ __('messages.not buy')  }}</span>
                                                                                </td>
                                                                            @else
                                                                                <td><span
                                                                                        class="badge badge-pill badge-warning">{{__('messages.par buy')}}</span>
                                                                                </td>
                                                                            @endif
                                                                            <td>{{ $x->Payment_Date }}</td>
                                                                            <td>
                                                                                {{ $x->note }}
                                                                    {{ app()->getLocale() === 'en' ? $x->note_en :  $x->note_ar}}
                                                                            </td>
                                                                            <td>{{ $x->created_at }}</td>
                                                                            <td>{{ $x->user }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                        </div>

                                                        <div class="tab-pane" id="tab6">
                                                            <!--المرفقات-->
                                                            <div class="card card-statistics">
{{--                                                                @can('اضافة مرفق')--}}
                                                                    <div class="card-body">
                                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                                        <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                                              enctype="multipart/form-data">
                                                                            {{ csrf_field() }}
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                                       name="file_name" required>
                                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                                       value="{{ $invoices->invoice_number }}">
                                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                                       value="{{ $invoices->id }}">
                                                                                <label class="custom-file-label" for="customFile">حدد
                                                                                    المرفق</label>
                                                                            </div><br><br>
                                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                                    name="uploadedFile">تاكيد</button>
                                                                            @error('file_name')
                                                                          <div class="text-danger text">{{ $message }} </div>
                                                                            @endif
                                                                        </form>
                                                                    </div>
{{--                                                                @endcan--}}
                                                                <br>

                                                                <div class="table-responsive mt-15">
                                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                                           style="text-align:center">
                                                                        <thead>
                                                                        <tr class="text-dark">
                                                                            <th scope="col">م</th>
                                                                            <th scope="col">اسم الملف</th>
                                                                            <th scope="col">قام بالاضافة</th>
                                                                            <th scope="col">تاريخ الاضافة</th>
                                                                            <th scope="col">العمليات</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php $i = 0; ?>
                                                                        @foreach ($attach as $attachment)
                                                                            <?php $i++; ?>
                                                                            <tr>
                                                                                <td>{{ $i }}</td>
                                                                                <td>{{ $attachment->file_name }}</td>
                                                                                <td>{{ $attachment->created_By }}</td>
                                                                                <td>{{ $attachment->created_at }}</td>
                                                                                <td colspan="2">

                        <a class="btn btn-outline-success btn-sm" target="_blank"
                           href="{{ url('View_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                           role="button"><i class="fas fa-eye"></i>&nbsp;
                            عرض</a>

                        <a class="btn btn-outline-info btn-sm"
                           href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
                           role="button"><i
                                class="fas fa-download"></i>
                            تحميل</a>
                                <button class="btn btn-outline-danger btn-sm"
                                        data-toggle="modal"
                                        data-file_name="{{ $attachment->file_name }}"
                                        data-invoice_number="{{ $attachment->invoice_number }}"
                                        data-id_file="{{ $attachment->id }}"
                                        data-target="#delete_file">حذف</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
{{--                                    {{ route('delete_file') }}"--}}
                                    <form action="{{ route('delete_file')}}" method="post">

                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <p class="text-center">
                                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                            </p>

                                            <input type="hidden" name="id_file" id="id_file" value="">
                                            <input type="hidden" name="file_name" id="file_name" value="">
                                            <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- /div -->

					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)

        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })

</script>
@endsection
