<?php

namespace App\Exports;

use App\Models\Sale;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleExport implements FromView
{
    private $from;
    private $to;
    private $sales;
    private $total;
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->sales = Sale::whereBetween("created_at", [$from, $to])
            ->where("payment_status", "Paid")->get();
        $this->total = $this->sales->sum("total_price");
    }
    public function view(): View
    {
        return view("Report.export")->with([
            'total' => $this->total,
            "from" => $this->from,
            "to" => $this->to,
            "sales" => $this->sales
        ]);
    }
}
