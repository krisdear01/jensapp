<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExpenseService;

class ExpenseController extends Controller
{
    protected $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    public function AddExpense()
    {
        return view('backend.expense.add_expense');
    }

    public function StoreExpense(Request $request)
    {
        $this->expenseService->createExpense($request);

        $notification = array(
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function TodayExpense()
    {
        $today = $this->expenseService->getTodayExpenses();
        return view('backend.expense.today_expense', compact('today'));
    }

    public function EditExpense($id)
    {
        $expense = $this->expenseService->getExpenseById($id);
        return view('backend.expense.edit_expense', compact('expense'));
    }

    public function UpdateExpense(Request $request)
    {
        $this->expenseService->updateExpense($request, $request->id);

        $notification = array(
            'message' => 'Expense Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('today.expense')->with($notification);
    }

    public function MonthExpense()
    {
        $monthexpense = $this->expenseService->getThisMonthExpenses();
        return view('backend.expense.month_expense', compact('monthexpense'));
    }

    public function YearExpense()
    {
        $yearexpense = $this->expenseService->getThisYearExpenses();
        return view('backend.expense.year_expense', compact('yearexpense'));
    }
}
 