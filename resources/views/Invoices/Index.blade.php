@extends('layouts.master')
@section('title')
   / {{ trans('messages.Invoices Menu') }}
@stop
@section('css')

    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
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
							<h4 class="content-title mb-0 my-auto">{{ __('messages.Invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('messages.Invoices Menu') }}</span>
						</div>
					</div>
				</div>
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100" role="alert">
                        <strong class="">{{ session()->get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&time;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('update'))
                    <div class="alert alert-success alert-dismissible fade show mx-auto text-center w-100" role="alert">
                        <strong class="">{{ session()->get('update') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&time;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('delete_invoice'))
                    <script>
                        window.onload = function() {
                            notif({
                                msg: "تم حذف الفاتورة بنجاح",
                                type: "success"
                            })
                        }

                    </script>
                @endif
                @if(session()->has('restore'))
                    <script>
                        window.onload = function (){
                            notif({
                                msg: "تم استعاده الفاتوره بنجاح 💕💕💕💕",
                                type:"info"
                            })
                        }
                    </script>
                @endif
    @if(session()->has('archev_invoice'))
        <script>
            window.onload = function (){
                notif({
                    msg:"تم ارشفه الفاتوره بنجاح 😎😎😎",
                    type:"info",
                })
            }
        </script>

    @endif

        @if(session()->has('delete_invoices'))
        <script>
            window.onload = function (){
                notif({
                    msg:"تم حذف الفاتوره بنجاح",
                    type:"info",
                })
            }
        </script>
        @endif
@endsection
@section('content')
				<div class="row">
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                       <a class="modal-effect btn btn-outline-primary px-3"  href="{{ LaravelLocalization::localizeUrl( route('invoices.create')) }}">{{ trans('messages.add category') }}</a>
{{--                                     @can('اضافة فاتور')  <a class="modal-effect btn btn-outline-primary px-3"  href="{{ LaravelLocalization::localizeUrl( route('invoices.create')) }}">{{ trans('messages.add category') }}</a>@endcan--}}
                                       @can('تصدير EXCEL') <a class="modal-effect btn btn-outline-primary  px-3"  href="{{ LaravelLocalization::localizeUrl( route('export.excel')) }}">{{ trans('messages.export.excel') }}</a>@endcan
                                 </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ trans('messages.Invoices Number') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.Invoices Date') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.Invoices OK') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.product') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.category') }}</th>
{{--                                                <th class="border-bottom-0">{{ trans('messages.Date Ok') }}</th>--}}
                                                <th class="border-bottom-0">{{ trans('messages.Discount') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.value Buy') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.Many Buy') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.Total') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.status') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.note') }}</th>
                                                <th class="border-bottom-0">{{ trans('messages.controller') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $num = 0;
                                            $any = LaravelLocalization::getCurrentLocale();
                                            ?>
                                            @if(isset($invoices) && $invoices->count() > 0)
                                                @forelse($invoices as $invoice)

                                                    <tr>
                                                        <?php $num++; ?>
                                                        <td>{{ $num }}</td>
                                                        <td>{{ $invoice->invoice_number }}</td>
                                                        <td>{{ $invoice->invoice_Date }}</td>
                                                        <td>{{ $invoice->due_Date }}</td>
                                                        <td>{{ $invoice->product  }}</td>
                                                        <td>
    <a href="{{ LaravelLocalization::localizeUrl(route('section.Details',$invoice->id)) }}">
        {{ app()->getLocale() === 'en' ? $invoice->section->section_name_en : $invoice->section->section_name_ar   }}</a>
                                                        </td>
                                                            <td>{{ $invoice->Discount   }}</td>
                                                        <td>{{ $invoice->Rate_Vat   }}</td>
                                                        <td>{{ $invoice->Value_Vat   }}</td>
                                                        <td>{{ $invoice->Total   }}</td>
                                                        <td>@if ($invoice->status === '2')
                                                                <span class="text-danger">{{__('messages.not buy')}}<span>

                                                            @elseif($invoice->status === '1')
                                                                <span class="text-warning">{{__('messages.good buy')}}</span>
                                                            @else
                                                                <span class="text-black">..</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $invoice->note   }}</td>
                                                        <td class="border-bottom-0">
                                                            <a href="{{ LaravelLocalization::localizeUrl( route('Invoices.edit',$invoice->id)) }}" title="edit the invoices"
                                                               class="fa fa-edit text-success"
                                                            ></a>
                                                            <a  class="text-danger fas px-1 fa-trash-alt" href="#" data-invoice_id="{{ $invoice->id }}"
                                                               data-toggle="modal" data-target="#delete_invoice" title="delete the invoices">
                                                                 </a>
                                                            <a href="{{ LaravelLocalization::localizeUrl( route('Invoices.editActive',$invoice->id)) }}"
                                                               class="fa fa-edit text-black" title="change status buy"
                                                            ></a>
{{--                                                            Invoices.achive--}}
                                                            <a  href="#" data-invoice_id="{{ $invoice->id }}" title="add to archeav"
                                                               data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                    class="text-warning fas fa-exchange-alt"></i>
                                                            </a>

                                                            <a href="{{ LaravelLocalization::localizeUrl( route('Print.Invoices',$invoice->id)) }}" title="Print the invoices"
                                                               class="fa fa-print text-success"
                                                            ></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            @endif

                                            </tbody>
{{--                                            <div class="d-flex justify-content-center">--}}
{{--                                                {!! $invoices->links() !!}--}}
{{--                                            </div>--}}
                                        </table>
                                    </div>
                                    <!-- حذف الفاتورة -->
                                    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}

                                                <div class="modal-body">
                                                    هل انت متاكد من عملية الحذف ؟
                                                    <input type="hidden"  name="invoice_id" id="invoice_id" value="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="Transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                            <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                                            {{ method_field('delete') }}
                                            {{ csrf_field() }}

                                        <div class="modal-body">
                                            هل انت متاكد من عملية الارشفة ؟
                                            <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                            <input type="hidden" name="id_page" id="id_page" value="2">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-success">تاكيد</button>
                                        </div>
                                        </form>
                                    </div>
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
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>
@endsection
