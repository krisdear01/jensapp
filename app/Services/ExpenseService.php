<?php

namespace App\Services;

use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExpenseService
{
    protected $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function createExpense(Request $request)
    {
        $data = $request->all();
        $data['created_at'] = Carbon::now();
        return $this->expenseRepository->create($data);
    }

    public function getExpenseById(int $id)
    {
        return $this->expenseRepository->find($id);
    }

    public function updateExpense(Request $request, int $id)
    {
        $data = $request->all();
        $data['created_at'] = Carbon::now();
        return $this->expenseRepository->update($id, $data);
    }

    public function getTodayExpenses()
    {
        return $this->expenseRepository->getTodayExpenses();
    }

    public function getThisMonthExpenses()
    {
        $month = date("F");
        return $this->expenseRepository->getMonthExpenses($month);
    }

    public function getThisYearExpenses()
    {
        $year = date("Y");
        return $this->expenseRepository->getYearExpenses($year);
    }
}
