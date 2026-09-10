<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryTransaction;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryController extends Controller
{
    public function index(Request $request): View
    {
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);

        $transactions = SalaryTransaction::query()
            ->with('staff')
            ->when($request->filled('staff_id'), fn ($q) => $q->where('staff_id', $request->integer('staff_id')))
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->string('type')))
            ->when($request->boolean('filter_month'), fn ($q) => $q->where(function ($q) use ($month, $year) {
                $q->where(fn ($q) => $q->where('month', $month)->where('year', $year))
                    ->orWhere(fn ($q) => $q->where('type', SalaryTransaction::TYPE_ADVANCE)
                        ->whereMonth('transaction_date', $month)
                        ->whereYear('transaction_date', $year));
            }))
            ->latest('transaction_date')
            ->get();

        $staffMembers = Staff::query()->orderBy('name')->get();

        $summaries = $staffMembers->map(function (Staff $staff) use ($month, $year) {
            $salaryPaid = SalaryTransaction::query()
                ->where('staff_id', $staff->id)
                ->where('type', SalaryTransaction::TYPE_SALARY)
                ->where('month', $month)
                ->where('year', $year)
                ->sum('amount');

            $advancePaid = SalaryTransaction::query()
                ->where('staff_id', $staff->id)
                ->where('type', SalaryTransaction::TYPE_ADVANCE)
                ->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year)
                ->sum('amount');

            $totalPaid = $salaryPaid + $advancePaid;
            $remaining = max(0, (float) $staff->monthly_salary - $totalPaid);

            return [
                'staff' => $staff,
                'monthly_salary' => (float) $staff->monthly_salary,
                'salary_paid' => (float) $salaryPaid,
                'advance_paid' => (float) $advancePaid,
                'total_paid' => (float) $totalPaid,
                'remaining' => $remaining,
            ];
        });

        $totals = [
            'monthly' => $summaries->sum('monthly_salary'),
            'paid' => $summaries->sum('total_paid'),
            'remaining' => $summaries->sum('remaining'),
        ];

        return view('admin.salaries.index', [
            'transactions' => $transactions,
            'staffMembers' => $staffMembers,
            'summaries' => $summaries,
            'totals' => $totals,
            'month' => $month,
            'year' => $year,
            'types' => [SalaryTransaction::TYPE_SALARY, SalaryTransaction::TYPE_ADVANCE],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'staff_id' => ['required', 'exists:staff,id'],
            'type' => ['required', 'in:' . SalaryTransaction::TYPE_SALARY . ',' . SalaryTransaction::TYPE_ADVANCE],
            'amount' => ['required', 'numeric', 'min:0'],
            'transaction_date' => ['required', 'date'],
            'month' => ['nullable', 'integer', 'min:1', 'max:12'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'note' => ['nullable', 'string'],
        ]);

        if ($validated['type'] === SalaryTransaction::TYPE_SALARY) {
            $validated['month'] = $validated['month'] ?? (int) now()->format('n');
            $validated['year'] = $validated['year'] ?? (int) now()->format('Y');
        }

        SalaryTransaction::query()->create($validated);

        return redirect()
            ->route('admin.salaries.index', [
                'month' => $validated['month'] ?? now()->month,
                'year' => $validated['year'] ?? now()->year,
                'filter_month' => 1,
            ])
            ->with('success', ucfirst($validated['type']) . ' recorded successfully.');
    }
}
