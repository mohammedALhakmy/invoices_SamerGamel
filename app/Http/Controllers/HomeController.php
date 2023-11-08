<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invocie;
use chartjs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       /* $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([12, 33, 44, 44, 55, 23, 40])->options([]);
//        $char = "";
//        dd($char);
        return view('index',compact('chartjs'));
*/


       /*$chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                ],
                [
                    "label" => "My Second dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [12, 33, 44, 44, 55, 23, 40],
                ]
            ])
            ->options([]);*/
       /* $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 150])
            ->labels([' نسبة الفواتير المدفوعة جزئيا',' نسبة الفواتير الغير مدفوعه','نسبة الفواتير المدفوعة'])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
//                    "label" => "نسبة الفواتير الغير مدفوعة",
                    "label" => "My First dataset",
                    'backgroundColor' => ['#e63946','#06d6a0'],  // الفواتير الغير مدفوعة + الفواتير المدفوعة جزئيا
                    'data' => [50,59] // نسبة الفواتير الغير مدفوعة + نسبة الفواتير المدفوعة جزئيا
                ],
                [
//                    "label" =>"نسبة الفواتير المدفوعة",
                    "label" => "My First dataset",
                    'backgroundColor' => ['#fb5607','#3a86ff'], // الفواتير المدفوعة + اجمالي الفواتير
                    'data' => [62,100] // نسبة الفواتير المدفوعة + اجمالي الفواتير
                ]
            ])
            ->options([]);*/

       /* $chartjs = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                    'data' => [69, 59]
                ]
            ])
            ->options([]);
*/


        /*$count_all =Invocie::count();
        $count_invoices2 = Invocie::where('value_status', 2)->count(); // الفواتير الغير المدفوعة تساوي قيمه 2
        $count_invoices1 = Invocie::where('value_status', 1)->count(); //
        $count_invoices3 = Invocie::where('value_status', 3)->count();

        if($count_invoices2 == 0){
            $nspainvoices2=0;
        }
        else{
            $nspainvoices2 = $count_invoices2/ $count_all*100;
        }

        if($count_invoices1 == 0){
            $nspainvoices1=0;
        }
        else{
            $nspainvoices1 = $count_invoices1/ $count_all*100;
        }

        if($count_invoices3 == 0){
            $nspainvoices3=0;
        }
        else{
            $nspainvoices3 = $count_invoices3/ $count_all*100;
        }
*/

        /*$chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [66,66]
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [66,99]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [35,35]
                ],


            ])
            ->options([]);
*/


        $count_all = Invocie::count();
        $count_invoices2 = Invocie::where("status","=",2)->count(); //الفواتير الغير مدفوعة
        $nspainvoices2 = $count_invoices2 / $count_all*100;

        $count_invoices1 = Invocie::where("status","=",1)->count();  // الفواتير المدفوعة
        $nspainvoices1 = $count_invoices1 / $count_all*100;


        $count_invoices3 = Invocie::where("status","=",3)->count();   // الفواتير المدفوعة جزئيا
        $nspainvoices3 = $count_invoices3 / $count_all*100;


        $chartjs = app()->chartjs
    ->name('barChartTest')
    ->type('bar')
    ->size(['width' => 350, 'height' => 150])
    ->labels(['الفواتير الغير المدفوعة','الفواتير المدفوعة جزئيا' ,'الفواتير المدفوعة'])
    ->datasets([
        [
            "label" => "نسبة الفواتير",
            'backgroundColor' => ['#FF6384',"#f77f00","#06d6a0"],
            'borderColor'=>"rgba(38,185,154,0.7)",
            'pointBorderColor'=>"rgba(38,185,154,0.7)",
            'pointBackgroundColor'=>"rgba(38,185,154,0.7)",
            'pointHoverBackgroundColor'=>"#fff",
            'pointHoverBorderColor'=>"rgba(220,220,220,1)",
            'data' => [$nspainvoices2,$nspainvoices3,$nspainvoices1]
        ],

    ])
    ->options([
        'legend'=>[
            'display' => true,
            'labels' => [
                'fontColor' => 'black',
                'fontFamily' => 'Cairo',
                'fontStyle' => 'bold',
                'fontSize' => 20
            ]
        ]
    ]);



        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214','#ff9642','#ec5858'],
                    'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
                ]
            ])
            ->options([]);



        return view('index', compact('chartjs','chartjs_2'));
    }

    public function test(){
        $char = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([12, 33, 44, 44, 55, 23, 40])->options([]);
//        $char = "";
//        dd($char);
        return view('index',compact('char'));

    }

}
