<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Reply;
use App\Http\Controllers\AdminBaseController;

use App\Http\Requests\Admin\Payroll\DeleteRequest;
use App\Http\Requests\Admin\Payroll\EditRequest;
use App\Http\Requests\Admin\Payroll\ShowRequest;
use App\Http\Requests\Admin\Payroll\StoreRequest;
use App\Http\Requests\Admin\Payroll\UpdateRequest;
use App\Models\Award;
use App\Models\Department;
use App\Models\EmailTemplate;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Payroll;
use App\Models\Salary;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use Yajra\DataTables\Facades\DataTables;
use function Matrix\add;

class PayrollsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans("pages.payroll.indexTitle");
        $this->payrollOpen = 'active open';
        $this->payrollActive = 'active';
        $this->hrMenuActive = 'active';
    }

    public function index()
    {
        $this->employees = Employee::select('id', 'full_name', 'employeeID')
            ->where('status', '=', 'active')
            ->get();
        return View::make('admin.payrolls.index', $this->data);
    }

    // Datatable ajax request
    public function ajax_payrolls(Request $request)
    {

        $result = Employee::manager(admin()->id)
            ->join('payrolls', 'payrolls.employee_id', '=', 'employees.id')
            ->select(
                DB::raw('(@cnt := if(@cnt IS NULL, 0,  @cnt) + 1) AS s_id'),
                'payrolls.id',
                'employees.employeeID as employeeID',
                'employees.full_name',
                'department.name',
                DB::raw('CONCAT(LPAD(payrolls.month,2, 0), "-", payrolls.year) as year'),
                'payrolls.net_salary',
                'payrolls.created_at',
                'payrolls.employee_id',
                'payrolls.status'
            );

        if ($request->employee_id !== 'all') {
            $result = $result->where('employees.id', $request->employee_id);
        }

        return DataTables::of($result)
            ->filterColumn('year', function ($query, $keyword) {
                $sql = "CONCAT(LPAD(payrolls.month,2, 0), \"-\", payrolls.year)  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($row) {
                return date('d-M-Y', strtotime($row->created_at));
            })
            ->editColumn('id', function () {
                static $row = 0;
                $row++;
                return $row;
            })
            ->editColumn('status', function ($row) {
                $color = ['paid' => 'success', 'unpaid' => 'danger'];

                return "<span id='status{$row->id}' class='label label-{$color[$row->status]}'>" .
                    trans("core." . $row->status) . "</span>";
            })
            ->editColumn('net_salary', function ($row) {
                return round($row->net_salary, 2);
            })
            ->addColumn('actions', '
               <a style="width: 75px;" class="btn blue-madison btn-sm margin-bottom-5"  href="{{ route(\'admin.payrolls.show\',$id)}}" ><i class="fa fa-eye"></i> {{trans("core.btnView")}}</a>
               <a style="width: 75px;" class="btn purple btn-sm margin-bottom-5"  href="{{ route(\'admin.payrolls.edit\',$id)}}" ><i class="fa fa-edit"></i> {{trans("core.edit")}}</a>
               <a class="blue-ebonyclay btn btn-sm margin-bottom-5"  href="{{ route(\'admin.payrolls.downloadpdf\',$id)}}" ><i class="fa fa-download"></i> {{trans("core.btnDownload")}} PDF</a>
               <a style="width: 75px;" href="javascript:;" onclick="del(\'{{ $id }}\');return false;" class="btn red btn-sm margin-bottom-5">
               <i class="fa fa-trash"></i> {{trans("core.btnDelete")}}</a>')
            ->editColumn('full_name', function ($row) {
                return $row->decryptToCollection()->full_name;
            })
            ->rawColumns(['actions', 'status'])
            ->make();
    }


    public function create()
    {
        $this->pageTitle = trans("pages.payroll.createTitle");
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id', 'employeeID')
            ->where('status', '=', 'active')->get();

        return View::make('admin.payrolls.create', $this->data);
    }

    public function multiple()
    {
        $this->pageTitle = trans("pages.payroll.createTitle");
        $this->employees = Employee::manager()
            ->select('full_name', 'employees.id', 'employeeID')
            ->where('status', '=', 'active')->get();

        return View::make('admin.payrolls.multiple', $this->data);
    }

    public function check()
    {
        $this->payrolls = Payroll::where('employee_id', '=', request()->get('employee_id'))
            ->where('month', '=', request()->get('month'))
            ->where('year', '=', request()->get('year'))->first();
        try {
            $this->basicSalary = Salary::where('employee_id', '=', request()->get('employee_id'))
                ->where('type', '=', 'basic')->first()->salary;
        } catch (\Exception $e) {
            $this->basicSalary = 0;
        }

        try {
            $this->hourly_rate = Salary::where('employee_id', '=', request()->get('employee_id'))
                ->where('type', '=', 'hourly_rate')->first()->salary;
        } catch (\Exception $e) {
            $this->hourly_rate = 0;
        }

        if ($this->payrolls) {
            $output['success'] = 'success';
            $output['content'] = View::make('admin.payrolls.create_edit', $this->data)->render();
        } else {
            $this->expense = Expense::selectRaw('month(purchase_date) as month,year(purchase_date) as year, sum(price) as sum,employee_id')
                ->groupBy('month', 'year', 'employee_id')->orderBy('month', 'desc')
                ->where('employee_id', '=', request()->get('employee_id'))
                ->where('status', '=', 'approved')
                ->whereRaw("month(purchase_date) ='" . request()->get('month') . "'")
                ->whereRaw("year(purchase_date) ='" . request()->get('year') . "'")->get()
                ->first();

            $this->expense = isset($this->expense->sum) ? $this->expense->sum : 0;
            $monthName = date('F', mktime(0, 0, 0, request()->get('month'), 10)); // March

            $this->awardBonus = Award::selectRaw('sum(cash_price) as sum')
                ->where('employee_id', '=', request()->get('employee_id'))
                ->where('month', '=', strtolower($monthName))
                ->where('year', '=', request()->get('year'))->first();

            $this->awardBonus = isset($this->awardBonus->sum) ? $this->awardBonus->sum : 0;

            $output['success'] = 'fail';
            $output['content'] = View::make('admin.payrolls.create_add', $this->data)->render();
        }


        return Response::json($output, 200);
    }

    /**
     * @param StoreRequest $request
     * @return array
     */
    public function store(StoreRequest $request)
    {
        $output = [];
        $deductions = [];
        $allowances = [];
        $input = $request->all();

        // Allowances
        $i = 0;
        if (isset($input['allowanceTitle'])) {
            foreach ($input['allowanceTitle'] as $title) {
                if ($title != '') {
                    $allowances[$title] = $input['allowance'][$i];
                }
                $i++;
            }
        }
        // Deductions
        $i = 0;
        if (isset($input['deductionTitle'])) {
            foreach ($input['deductionTitle'] as $title) {
                if ($title != '') {
                    $deductions[$title] = $input['deduction'][$i];
                }
                $i++;
            }
        }

//        return response()->json($deductions);

        $payroll = Payroll::firstOrNew(['employee_id' => $input['employee_id'], 'month' => $input['month'],
            'year' => $input['year'],]);

        $payroll->basic = $input['basic'];
        $payroll->overtime_hours = $input['overtime_hours'];
        $payroll->overtime_pay = $input['overtime_pay'];
        $payroll->allowances = json_encode($allowances);
        $payroll->deductions = json_encode($deductions);
        $payroll->total_deduction = $input['total_deduction'];
        $payroll->expense = $input['expense'];
        $payroll->total_allowance = $input['total_allowance'];
        $payroll->net_salary = $input['net_salary'] + $input['nhif_relief'];
        $payroll->company_id = admin()->company_id;
        $payroll->nhif_relief = $input['nhif_relief'];
//        $payroll->status = $request->status;
        $payroll->status = 'unpaid';
        $payroll->save();

        if (isset($input['type'])) {
            return Reply::redirect(route('admin.payrolls.index'), 'messages.payrollUpdateMessage');
        }
        return Reply::redirect(route('admin.payrolls.index'), 'messages.payrollAddMessage');

    }

    public function calculateNhif($gross)
    {
        $amount = 0;
        switch ($gross) {
            case $gross < 5999:
                return $amount = 150;
            case $gross >= 6000 && $gross < 8000 :
                return $amount = 300;
            case $gross >= 8000 && $gross < 12000 :
                return $amount = 400;
            case $gross >= 12000 && $gross < 15000 :
                return $amount = 500;
            case $gross >= 15000 && $gross < 20000 :
                return $amount = 600;
            case $gross >= 20000 && $gross < 25000 :
                return $amount = 750;
            case $gross >= 25000 && $gross < 30000 :
                return $amount = 850;
            case $gross >= 30000 && $gross < 35000 :
                return $amount = 900;
            case $gross >= 35000 && $gross < 40000 :
                return $amount = 950;
            case $gross >= 40000 && $gross < 45000 :
                return $amount = 1000;
            case $gross >= 45000 && $gross < 50000 :
                return $amount = 1100;
            case $gross >= 50000 && $gross < 60000 :
                return $amount = 1200;
            case $gross >= 60000 && $gross < 70000 :
                return $amount = 1300;
            case $gross >= 70000 && $gross < 80000 :
                return $amount = 1400;
            case $gross >= 80000 && $gross < 90000 :
                return $amount = 1500;
            case $gross >= 90000 && $gross < 100000 :
                return $amount = 1600;
            default :
                return $amount = 1700;
        }
    }


    public function calculatePayee($gross)
    {
        $amount = 0;
        switch ($gross) {
            case $gross <= 24000 :
                return $amount = 0;
            case $gross > 24000 && $gross <= 40667 :
                return $amount = $gross * 0.15;
            case $gross > 40667 && $gross <= 57333 :
                return $amount = $gross * 0.2;
            default:
                return $amount = $gross * 0.25;
        }
    }

    Public function calculateNhifRelief($payee,$nhif)
    {
      $amount = 0;
      switch ($payee){
          case $payee <= 0:
            return $amount = 0;
          default:
            return $amount = $nhif * 0.15;
      }
    }

    Public function calculateNssf($gross){
        $amount = 0;
            switch (true) {
                case $gross < 18000:
                   return $amount = $gross * 0.06;
                case $gross >= 18000 :
                   return $amount = 1080;
                default :
                   return $amount = 1080;
            }
        
    }


    /**
     * @param ShowRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(ShowRequest $request, $id)
    {
        $this->pageTitle = trans("pages.payroll.showTitle");

        $this->payroll = Payroll::findOrFail($id);
        $this->employee = $this->payroll->employee;
        $this->payslip_num = Payroll::where('payrolls.id', '<=', $id)->count();
//        print_r($this->payroll->allowances);die;


        return View::make('admin.payrolls.show_pdf', $this->data);
    }

    /**
     * @param EditRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditRequest $request, $id)
    {
        $this->pageTitle = trans("pages.payroll.editTitle");

        $this->payroll = Payroll::find($id);

        try {
            $this->hourly_rate = Salary::where('employee_id', '=', $this->payroll->employee_id)
                ->where('type', '=', 'hourly_rate')->first()->salary;
        } catch (\Exception $e) {
            $this->hourly_rate = 0;
        }

        return View::make('admin.payrolls.edit', $this->data);
    }

    public function downloadPdf($id)
    {
        $this->payroll = Payroll::with('employee')->findOrFail($id);
        $this->employee = $this->payroll->employee;
        $this->payslip_num = Payroll::where('payrolls.id', '<=', $id)->count();
        return \PDF::loadView("admin.payrolls.pdfview", $this->data)
            ->download($this->payroll->employee_id . "-" . date('F', mktime(0, 0, 0, $this->payroll->month, 10)) . "-" . $this->payroll->year . ".pdf");
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $payroll = Payroll::findOrFail($id);

        $payroll->update($data);

        return Redirect::route('admin.payrolls.index');
    }


    public function report2()
    {
        $salaries = Payroll::companywithdept($this->company_id)
            ->select('employees.employeeID', 'full_name', 'department.name', 'designation.designation', 'payrolls.basic', 'total_allowance', 'deductions')
            ->where('month', '=', request()->get('month'))->where('year', '=', request()->get('year'))->get()
            ->toArray();

//        print_r($salaries);die;
        $monthName = date('F', mktime(0, 0, 0, request()->get('month'), 10)); // March
        $data = [[''], [admin()->company->company_name, '', '', '', '',],
            ['Payroll Report', '', '', ''], [''],
            ['Period:', $monthName . ',' . request()->get('year'), '', 'Printed On:', date('d/m/Y, g:i a')],
            [''],

            ['Employee ID', 'Employee Name', 'Department', 'Designation', 'Basic Salary', 'Benefits',
                'Gross Pay', '30%', 'NSSF', 'Permissible Limit', 'Chargeble Pay', 'Tax Payable', 'Relief', 'PAYE'],

        ];

        foreach ($salaries as $salary) {
            $employee = Employee::where('employeeID', $salary['employeeID'])->first();
            $paye = collect(json_decode($salary['deductions']))->get('PAYE');
            $salary['full_name'] = $employee->decryptToCollection()->full_name;
            $salary['deductions'] = $gross = $salary['basic'] + $salary['total_allowance'];
            $salary['30%'] = $gross * 0.3;
            $salary['NSSF'] = $this->calculateNssf($gross);
            $salary['Permissible_limit'] = 10000;
            $salary['chargable_pay'] = $gross - $this->calculateNssf($gross);;
            $salary['tax_payable'] = ($paye > 0) ? $paye + 2400 : 0;
            $salary['relief'] = ($paye > 0) ? 2400 : 0;
            $salary['paye'] = $paye;
            $data[] = array_values($salary);
        }
        //print_r($data);die;

        return (new Collection($data))->downloadExcel('payrolReport.xlsx');
    }

    public function report()
    {
        $reports = Payroll::companywithdept($this->company_id)
            ->select('payrolls.id', 'employees.employeeID', 'full_name', 'department.name', 'designation.designation', 'payrolls.basic', 'total_allowance', 'allowances', 'deductions')
            ->where('month', '=', request()->get('month'))->where('year', '=', request()->get('year'))->get();
//            ->toArray();

//        print_r($salaries);die;
        $monthName = date('F', mktime(0, 0, 0, request()->get('month'), 10)); // March

        $adds = $reports->pluck('allowances');
        $des = $reports->pluck('deductions');
        $additions = [];
        if (count($adds)) {
            foreach (($adds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $additions[] = $key;
                }
            }
        }
        $deductions = [];
        if (count($des)) {
            foreach (($des) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $deductions[] = $key;
                }
            }
        }
        $additions = array_unique($additions);
        $deductions = array_unique($deductions);

        $data = [[''], [admin()->company->company_name, '', '', '', '',],
            ['Payroll Report', '', '', ''], [''],
            ['Period:', $monthName . ',' . request()->get('year'), '', 'Printed On:', date('d/m/Y, g:i a')],
            [''],
            array_merge(['Employee ID', 'Employee Name', 'Department', 'Designation', 'Basic Salary', 'Benefits',
                'Gross Pay'], $additions, $deductions, ['Net Pay']),
        ];
        foreach ($reports as $salary) {
//            print_r($salary);die;
            $employee = Employee::where('employeeID', $salary['employeeID'])->first();
            $salary['full_name'] = $employee->decryptToCollection()->full_name;
            $salary['Gross_pay'] = $gross = $salary['basic'] + $salary['total_allowance'];
            $roll = Payroll::find($salary->id);

            foreach ($additions as $addition) {
                $add = collect(json_decode($salary->allowances))->get($addition);
                $salary[$addition] = $add;
            }
            foreach ($deductions as $addition) {
                $add = collect(json_decode($salary->deductions))->get($addition);
                $salary[$addition] = $add;
            }
            unset($salary['id']);
            unset($salary['allowances']);
            unset($salary['deductions']);
            $salary['netpay'] = $roll->net_salary;
            $data[] = array_values($salary->toArray());
        }
//        print_r($data);die;

        return (new Collection($data))->downloadExcel('payrolReport.xlsx');
    }


    public function destroy(DeleteRequest $request, $id)
    {
        Payroll::destroy($id);

        return Reply::success("messages.successDelete");
    }


    public function payrollSummary(Request $request): \Illuminate\Contracts\View\View
    {
        $this->data['reportActive'] = 'active';
        $this->pageTitle = 'Summary';
        $this->employees = Employee::select('id', 'full_name', 'employeeID')
            ->where('status', '=', 'active')
            ->get();
        $periods = Payroll::get(['month', 'year']);
        $this->data['years'] = $years = $periods->pluck('year')->unique()->sort();
        $this->data['months'] = $months = $periods->pluck('month')->unique()->sort();
        $this->data['departments'] = Department::where('company_id', $this->company_id)->get();

        if (!$request->isMethod("POST")) {
            return View::make('admin.reports.summary', $this->data);
        }


        $reports = Payroll::where('month', $request->month)
            ->leftJoin('employees', 'employees.id', '=', 'payrolls.employee_id')
            ->leftJoin('designation', 'designation.id', '=', 'employees.designation')
            ->where('year', $request->year)
            ->when($request->department_id != 'all', function ($q) use ($request) {
                return $q->where('designation.department_id', $request->department_id);
            })
            ->with(['employee'])
            ->get();
        $this->data['m'] = $request->month;
        $this->data['y'] = $request->year;
        // dd($reports);
        $adds = $reports->pluck('allowances');
        $des = $reports->pluck('deductions');
        $additions = [];
        if (count($adds)) {
            foreach (($adds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $additions[] = $key;
                }
            }
        }
        $deductions = [];
        if (count($des)) {
            foreach (($des) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $deductions[] = $key;
                }
            }
        }
        $additions = array_unique($additions);
        $deductions = array_unique($deductions);

        $this->data['reports'] = $reports;
        $this->data['additions'] = $additions;
        $this->data['deductions'] = $deductions;
        // dd();

        return View::make('admin.reports.summary', $this->data);

    }

    public function downloadSummary($m, $y)
    {
        $reports = Payroll::companywithdept($this->company_id)
            ->select('payrolls.id', 'employees.employeeID', 'full_name', 'department.name', 'designation.designation', 'payrolls.basic', 'total_allowance', 'allowances', 'deductions')
            ->where('month', '=', $m)->where('year', '=', $y)
//            ->where('month',)
            ->get();
//            ->toArray();

//        print_r($salaries);die;
        $monthName = date('F', mktime(0, 0, 0, $m, 10)); // March

        $adds = $reports->pluck('allowances');
        $des = $reports->pluck('deductions');
        $additions = [];
        if (count($adds)) {
            foreach (($adds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $additions[] = $key;
                }
            }
        }
        $deductions = [];
        if (count($des)) {
            foreach (($des) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $deductions[] = $key;
                }
            }
        }
        $additions = array_unique($additions);
        $deductions = array_unique($deductions);

        $data = [[admin()->company->company_logo], [admin()->company->company_name, '', '', '', '',],
            ['Payroll Report', '', '', ''], [''],
            ['Period:', $monthName . ',' . $y, '', 'Printed On:', date('d/m/Y, g:i a')],
            [''],
            array_merge(['Employee ID', 'Employee Name', 'Department', 'Designation', 'Basic Salary', 'Benefits',
                'Gross Pay'], $additions, $deductions, ['Net Pay']),
        ];
        foreach ($reports as $salary) {
            $employee = Employee::where('employeeID', $salary['employeeID'])->first();
            // print_r($employee);die();

            $salary['full_name'] = $employee->decryptToCollection()->full_name.' '.$employee->decryptToCollection()->father_name;
            // $salary->employee->full_name.' '.$salary->employee->father_name;
            $salary['Gross_pay'] = $gross = $salary['basic'] + $salary['total_allowance'];
            $roll = Payroll::find($salary->id);
            foreach ($additions as $addition) {
                $add = collect(json_decode($salary->allowances))->get($addition);
                $salary[$addition] = $add;
            }
            foreach ($deductions as $addition) {
                $add = collect(json_decode($salary->deductions))->get($addition);
                $salary[$addition] = $add;
            }
            unset($salary['id']);
            unset($salary['allowances']);
            unset($salary['deductions']);
            $salary['netpay'] = $roll->net_salary;
            $data[] = array_values($salary->toArray());
        }
//        print_r($data);die;

        return (new Collection($data))->downloadExcel('payrolReport.xlsx');
    }

    public function approvePayroll(Request $request)
    {
        $this->data['approve'] = 'active';
        $this->data['payrollActive'] = '';
        $this->pageTitle = 'Summary';
        $periods = Payroll::get(['month', 'year']);

        $this->data['years'] = $years = $periods->pluck('year')->unique()->sort();
        $this->data['months'] = $months = $periods->pluck('month')->unique()->sort();
        if (!$request->isMethod('POST')) {
            return view('admin.payrolls.approve', $this->data);
        }

        $payrolls = Payroll::where('month', $request->month)
            ->where('year', $request->year)
            ->with(['employee'])
            ->get();
        $this->data['payrolls'] = $payrolls;

        $adds = $payrolls->pluck('allowances');
        $des = $payrolls->pluck('deductions');
        $additions = [];
        if (count($adds)) {
            foreach (($adds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $additions[] = $key;
                }
            }
        }
        $deductions = [];
        if (count($des)) {
            foreach (($des) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $deductions[] = $key;
                }
            }
        }
        $additions = array_unique($additions);
        $deductions = array_unique($deductions);
        $this->data['additions'] = $additions;
        $this->data['deductions'] = $deductions;

        return view('admin.payrolls.approve', $this->data);

    }

    public function makePayments(Request $request)
    {
        $this->data['makePayments'] = 'active';
        $this->data['payrollActive'] = '';
        $this->pageTitle = 'Make Payments';
        $periods = Payroll::get(['month', 'year']);

        $this->data['years'] = $years = $periods->pluck('year')->unique()->sort();
        $this->data['months'] = $months = $periods->pluck('month')->unique()->sort();
        if (!$request->isMethod('POST')) {
            return view('admin.payrolls.make-payments', $this->data);
        }

        $payrolls = Payroll::where('month', $request->month)
            ->where('year', $request->year)
            ->where('is_approved', true)
            // ->where('status', 'unpaid')
            ->with(['employee'])
            ->get();
        $this->data['payrolls'] = $payrolls;

        $adds = $payrolls->pluck('allowances');
        $des = $payrolls->pluck('deductions');
        $additions = [];
        if (count($adds)) {
            foreach (($adds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $additions[] = $key;
                }
            }
        }
        $deductions = [];
        if (count($des)) {
            foreach (($des) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $deductions[] = $key;
                }
            }
        }
        $additions = array_unique($additions);
        $deductions = array_unique($deductions);
        $this->data['additions'] = $additions;
        $this->data['deductions'] = $deductions;

        return view('admin.payrolls.make-payments', $this->data);

    }

    public function approveSelectedPayrolls(Request $request)
    {
        $this->validate($request, [
            'selected' => 'required|array'
        ]);

        if ($request->has('selected')) {
            $selected = $request->selected;
            DB::transaction(function () use ($selected) {
                if (count($selected)) {
                    foreach ($selected as $payroll) {
                        $pp = Payroll::find($payroll);
                        $pp->is_approved = true;
                        $pp->state = 'APPROVED';
                        $pp->save();
                    }
                }
            });
        }
        return redirect()->back();
    }

    public function paySelectedPayrolls($id)
    {
        $returns = [];
        DB::transaction(function () use ($id,$returns) {
                $baseUrl = 'https://payments.cyncit.tech/newPayment';
                $userCode = 290;
                $pass = 'testPass!';
                $clientId = '3pBAyrI0qVlr7RS246DKFoHq6IumwsYA';
                $clientSecret = 'eRprAvGXS5am5wpKy9fJBIneHL5I_egGgR6ewiUrh_ZmUMS3uu9RTO81GIiWl9l2';
                $tokenUrl = 'https://payments.cyncit.tech/tokens';

                $token = Http::get($tokenUrl,[
                    'CLIENT_ID' => $clientId,
                    'CLIENT_SECRET' => $clientSecret
                ]);
                if($token->successful()){
                    $token = $token->json()['access_token'];
                    $timestamp = Carbon::now()->format('YmdHms');
                    $password = Http::post('https://payments.cyncit.tech/md5Password',[
                        'userCode' => $userCode,
                        'timestamp' => $timestamp,
                        'rawPassword' => $pass
                    ]);
                    $password = $password->json()['password'];
                    $payroll = Payroll::where('id',$id)->with('employee')->first();
                    $response = Http::withToken($token)
                        ->post($baseUrl, [
                            "shortCode" => "",
                            "netGrossCharges" => $payroll->net_pay,
                            "payoutAmount" => $payroll->net_pay,
                            "userCode" => $userCode,
                            "sysCode" => "",
                            "timestamp" => $timestamp,
                            "password" => $password,
                            "paymentRef" => "",
                            "purposeforFunds" => "Salary",
                            "transactionReference" => $payroll->id,
//                                    "transactionReference" => 1,
                            "receiverOthernames" => $payroll->employee->full_name,
                            "receiverSurname" => $payroll->employee->father_name,
                            "transferType" => "",
                            "resultURL" => url('paymentCallback')
                        ]);
                    if($response->successful()){
                        $payroll->payment_status = $status = $response->json()['transactionStatus'];
                        $payroll->status = 'paid';
                        $payroll->save();
                        $returns[] = $status;
                    }
                }

            });

        return response()->json($returns);
    }

}
