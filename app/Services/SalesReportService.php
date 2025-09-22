<?php

namespace App\Services;

use App\Repositories\SalesReportRepository;
use Carbon\Carbon;

class SalesReportService
{
    protected $salesReportRepository;

    public function __construct(SalesReportRepository $salesReportRepository)
    {
        $this->salesReportRepository = $salesReportRepository;
    }

    public function getTodaySales()
    {
        $today = Carbon::today();
        return $this->salesReportRepository->getTotalSalesBetween($today, $today->copy()->endOfDay());
    }

    public function getThisMonthSales()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        return $this->salesReportRepository->getTotalSalesBetween($monthStart, $monthEnd);
    }

    public function getThisYearSales()
    {
        $yearStart = Carbon::now()->startOfYear();
        $yearEnd = Carbon::now()->endOfYear();
        return $this->salesReportRepository->getTotalSalesBetween($yearStart, $yearEnd);
    }
}
