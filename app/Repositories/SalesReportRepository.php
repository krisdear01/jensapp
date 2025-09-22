<?php

namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;

class SalesReportRepository
{
    public function getTotalSalesBetween(Carbon $startDate, Carbon $endDate)
    {
        return Order::whereBetween('created_at', [$startDate, $endDate])->sum('total');
    }
}
