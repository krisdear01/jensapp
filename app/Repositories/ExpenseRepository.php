<?php

namespace App\Repositories;

use App\Models\Expense;
use Carbon\Carbon;

class ExpenseRepository
{
    public function create(array $data)
    {
        return Expense::create($data);
    }

    public function find(int $id)
    {
        return Expense::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $expense = Expense::findOrFail($id);
        $expense->update($data);
        return $expense;
    }

    public function getTodayExpenses()
    {
        $date = date("d-m-Y");
        return Expense::where('date', $date)->get();
    }

    public function getMonthExpenses(string $month)
    {
        return Expense::where('month', $month)->get();
    }

    public function getYearExpenses(string $year)
    {
        return Expense::where('year', $year)->get();
    }
}
