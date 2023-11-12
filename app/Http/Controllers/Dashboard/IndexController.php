<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Visit;
use App\Models\Technician;
use App\Models\User;
use App\Charts\CommonChart;
use Yajra\DataTables\DataTables;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    protected function index()
    {
        $customers = User::count();
        $client_orders = Order::where('is_active', 1)->count();
        $technicians = Technician::count();
        $tech_visits = Visit::where('is_active', 1)->count();

        $now = Carbon::now('Asia/Riyadh')->toDateString();

        $client_orders_today = Order::whereDate('created_at', '=', $now)->where('is_active', 1)->count();
        $tech_visits_today = Visit::whereDate('created_at', '=', $now)->where('is_active', 1)->count();




        // $all_sell_values = Transaction::select(\DB::raw("COUNT(*) as count"))

        // ->whereBetween('transactions.created_at', [ $least_7_days, $fy['end']])

        // ->groupBy(DB::raw('date(transactions.created_at)'))

        // ->pluck('count');


        $today = Carbon::now('Asia/Riyadh');
        $sevenDaysAgo = Carbon::now('Asia/Riyadh')->subDays(8);

        $all_sell_values = Order::where('is_active', 1)->select(\DB::raw("COUNT(*) as count"))
            ->whereBetween('created_at', [$sevenDaysAgo, $today])
            ->groupBy(\DB::raw('date(created_at)'))
            ->pluck('count');

        //Chart for sells last 7 days
        $labels = [];

        $dates = [];
        for ($i = $all_sell_values->count() - 1; $i >= 0; $i--) {
            $date = Carbon::now('Asia/Riyadh')->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $labels[] = date('j M Y', strtotime($date));
        }

        $sells_chart_1 = new CommonChart;

        $sells_chart_1->labels($labels)->options($this->__chartOptions(
            __(
                __('dash.orders'),
                ['currency' => 'SAR']
            )
        ));
        $sells_chart_1->dataset(__('dash.orders'), 'line', $all_sell_values);


        $today = Carbon::now('Asia/Riyadh');
        $monthAgo = Carbon::now('Asia/Riyadh')->subDays(31);

        $all_sell_values2 = Order::select(\DB::raw("COUNT(*) as count"))
            ->whereBetween('created_at', [$monthAgo, $today])
            ->groupBy(\DB::raw('date(created_at)'))
            ->pluck('count');

        //Chart for sells last 7 days
        $labels2 = [];

        $dates2 = [];
        for ($i = $all_sell_values2->count() - 1; $i >= 0; $i--) {
            $date2 = Carbon::now('Asia/Riyadh')->subDays($i)->format('Y-m-d');
            $dates2[] = $date2;

            $labels2[] = date('j M Y', strtotime($date2));
        }

        $sells_chart_2 = new CommonChart;

        $sells_chart_2->labels($labels2)->options($this->__chartOptions(
            __(
                __('dash.orders'),
                ['currency' => 'SAR']
            )
        ));
        $sells_chart_2->dataset(__('dash.orders'), 'line', $all_sell_values2);
        $canceled_orders = Order::where('status_id', 5)->where('is_active', 1)->count();
        $canceled_orders_today = Order::where('status_id', 5)->where('is_active', 1)->where(function ($qu) use ($now) {
            $qu->whereDate('created_at', $now)->orWhereDate('updated_at', $now);
        })->count();
        return view('dashboard.home', compact('canceled_orders', 'canceled_orders_today', 'tech_visits_today', 'client_orders_today', 'sells_chart_1', 'sells_chart_2', 'customers', 'client_orders', 'technicians', 'tech_visits'));
    }
    private function __chartOptions($title)
    {
        return [
            'yAxis' => [
                'title' => [
                    'text' => $title,
                ],
            ],
            'legend' => [
                'align' => 'right',
                'verticalAlign' => 'top',
                'floating' => true,
                'layout' => 'vertical',
                'padding' => 20,
            ],
        ];
    }
}
