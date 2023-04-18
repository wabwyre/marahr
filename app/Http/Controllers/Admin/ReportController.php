<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Department;
use App\Models\Bank_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;


class ReportController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->dashboardActive = 'active';
        $this->pageTitle = trans("pages.dashboard.title");
    }

    public function p9a(Request $request): \Illuminate\Contracts\View\View
    {
       
        $this->data['reportActive'] = 'active';
        $this->pageTitle = 'P9A';
        $this->employees = Employee::select('id', 'full_name', 'employeeID')
            ->where('status', '=', 'active')
            ->get();

        if (!$request->isMethod("POST")) {
            return View::make('admin.reports.p9a', $this->data);
        }

        $start = $request->from;
        $sdate = explode("-", $start);
        $syear = $sdate[0];
        $smonth = $sdate[1];

        $end = $request->to;
        $sd = explode("-", $end);
        $eyear = $sd[0];
        $emonth = $sd[1];

        //echo $emonth;
 

      if ($syear === $eyear){
        // echo $start;
        
            $reports = Payroll::with(['employee'])
                ->where('employee_id', $request->employee_id)
    //            ->where
                ->where('is_approved', '=', true)
                ->where('year', '=', $syear)
                //->whereBetween('month', [$smonth,$emonth])
                ->get();

            $adds = $reports->pluck('allowances');

            $des = $reports->pluck('deductions');
    //        print_r($des);die;
            $additions = [];

            $deductions = [];
            if (count($des)) {
                foreach (($des) as $allowance) {
                    foreach (json_decode($allowance) as $key => $value) {
                        if ($key == 'PAYE') {
                            $deductions[] = $key;
                        }
                    }
                }
            }
            $additions = array_unique($additions);
            $deductions = array_unique($deductions);
    //        print_r($additions);die;

            $this->data['reports'] = $reports->sortBy('month');
            $this->data['additions'] = $additions;
            $this->data['deductions'] = $deductions;
            $this->data['person'] = Employee::find($request->employee_id);
            // $this->data['pin']=Bank_details::find('employee_id ',$request->employee_id)->first();
            $this->data['pin2'] = Bank_detail::where('employee_id', $request->employee_id)->get();
            // where('id',1)->get();
            // $post = Post::where('id', $id);

            return View::make('admin.reports.p9a', $this->data);
        }

    }

    public function statutoryDeductions(Request $request): \Illuminate\Contracts\View\View
    {
        $this->data['reportActive'] = 'active';
        $this->pageTitle = 'P9A';
        $this->employees = Employee::select('id', 'full_name', 'employeeID')
            ->where('status', '=', 'active')
            ->get();
        $this->data['deductions'] = ['NHIF', 'NSSF', 'PAYE'];
//        print_r($request->all());die;

        if (!$request->isMethod("POST")) {
            return View::make('admin.reports.deductions', $this->data);
        }

        $reports = Payroll::with(['employee'])
            ->when($request->employee_id != 'all', function ($q) use ($request) {
                return $q->where('employee_id', $request->employee_id);
            })
            ->where('is_approved', '=', true)
            //->whereBetween('created_at', [$request->from,$request->to])
//            ->where('deductions')
            ->get();
//        if($request->deductions != 'all'){
//            $reports =  $reports->where
//        }

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
//        $this->data['deductions'] = $deductions;
        $this->data['deductionFilter'] = $request->deduction;


        return View::make('admin.reports.deductions', $this->data);

    }

    public function paymentShedule(Request $request): \Illuminate\Contracts\View\View
    {

             
            $this->data['reportActive'] = 'active';
            $this->pageTitle = 'Summary';
            $this->employees = Employee::select('id', 'full_name', 'employeeID')
                ->where('status', '=', 'active')
                ->get();
            $periods = Payroll::get(['month', 'year']);
            $this->data['years'] = $years = $periods->pluck('year')->unique()->sort();
            $this->data['months'] = $months = $periods->pluck('month')->unique()->sort();

            if (!$request->isMethod("POST")) {
                return View::make('admin.reports.summary2', $this->data);
            }
            


            $reports = Payroll::where('month', $request->month)
                ->where('year', $request->year)
                ->with(['employee.bank_details'])
                ->where('is_approved',true)
                ->get();
            // dd($reports);
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

            return View::make('admin.reports.summary2', $this->data);
        
    }

    public function downloadPaymentSchedule($month,$year){
        $reports = Payroll::where('month', $month)
            ->where('year', $year)
            ->with(['employee.bank_details'])
            ->where('is_approved',true)
            ->get();
//            ->toArray();

        // dd($reports);
        $this->data['m'] = $month;
        $this->data['y'] = $year;
//        print_r($reports->toArray());die;


        $data = [[''], [admin()->company->company_name, '', '', '', '',],
            ['Payments Schedule Summary', '', '', ''], [''],
            ['Period:', $month . ',' . request()->get('year'), '', 'Printed On:', date('d/m/Y, g:i a')],
            [''],

            ['No','Customer Ref','Beneficiary Name', 'Bank Code', 'Branch Code', 'Beneficiary Account', 'Payment Amount',
                'Transaction Type Code','Purpose Of Payment','Address','Charge Type','Currency','Bank Details','Payment Type'],

        ];
        $i=1;
        foreach($reports as $salary){
            $rec = [];
            $rec['No']= $i++;
            $rec['employeeID']=$salary->employee->employeeID;
            // $rec['name']= $salary->employee->father_name.' '.$salary->employee->full_name;
            $rec['name']= $salary->employee->full_name.' '.$salary->employee->father_name;
            $rec['bank_code'] = $salary->employee->bank_details->bin;
            $rec['code'] = $salary->employee->bank_details->branch;
            $rec['account'] = $salary->employee->bank_details->account_number;
            $rec['amount'] = $salary->net_salary;
            $rec['type'] = $salary->employee->bank_details->transaction_type_code;
            $rec['reason'] =\Carbon\Carbon::parse($salary->year."-".$salary->month."-".'01')->format('M'). ' Salaries';
            $rec['address'] = $salary->employee->permanent_address;
            $rec['charge_type'] = 'OUR';
            $rec['currency'] = 'KES';
            $rec['bank_details'] = $salary->employee->bank_details->bank;
            $rec['payment_type'] = $salary->employee->bank_details->payment_type;


            $data[] = array_values($rec);

        }

        return (new Collection($data))->downloadExcel('PaymentSchedule.xlsx');
    }
    public function employeeReport(Request $request){
        $this->data['reportActive'] = 'active';
        $this->pageTitle = 'Summary';
        if (!$request->isMethod("POST")) {
            return View::make('admin.reports.employeesReport', $this->data);
        }

        $this->employees = Employee::select('id', 'full_name', 'employeeID')
        ->when($request->status != 'all', function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return View::make('admin.reports.employeesReport', $this->data);

    }

    public function payrollVariations(Request $request): \Illuminate\Contracts\View\View
    {
        $this->data['reportActive'] = 'active';
        $this->pageTitle = 'Payroll Variations';
        $this->employees = Employee::select('id', 'full_name', 'employeeID')
            ->where('status', '=', 'active')
            ->get();
        $periods = Payroll::get(['month', 'year']);
        $this->data['years'] = $years = $periods->pluck('year')->unique()->sort();
        $this->data['months'] = $months = $periods->pluck('month')->unique()->sort();
        $this->data['departments'] = Department::where('company_id', $this->company_id)->get();

        if (!$request->isMethod("POST")) {
            return View::make('admin.reports.payroll', $this->data);
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


        $month = $request->month;
        $lmonth = $month - 1;
        
        $lreports = Payroll::where('month', $lmonth)
            ->leftJoin('employees', 'employees.id', '=', 'payrolls.employee_id')
            ->leftJoin('designation', 'designation.id', '=', 'employees.designation')
            ->where('year', $request->year)
            ->when($request->department_id != 'all', function ($q) use ($request) {
                return $q->where('designation.department_id', $request->department_id);
            })
            ->with(['employee'])
            ->get();
        $this->data['m'] = $lmonth;
        $this->data['y'] = $request->year;
        // dd($reports);
        $ladds = $lreports->pluck('allowances');
        $ldes = $lreports->pluck('deductions');
        $ladditions = [];
        if (count($ladds)) {
            foreach (($ladds) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $ladditions[] = $key;
                }
            }
        }
        $ldeductions = [];
        if (count($ldes)) {
            foreach (($ldes) as $allowance) {
                foreach (json_decode($allowance) as $key => $value) {
                    $ldeductions[] = $key;
                }
            }
        }
        $ladditions = array_unique($ladditions);
        $ldeductions = array_unique($ldeductions);

        $this->data['reports'] = $reports;
        $this->data['additions'] = $additions;
        $this->data['deductions'] = $deductions;
        $this->data['lreports'] = $lreports;
        $this->data['ladditions'] = $ladditions;
        $this->data['ldeductions'] = $ldeductions;

        //print_r($this->data['ldeductions']);

        return View::make('admin.reports.payroll', $this->data);
    }

    public function downloadVariations($m, $y)
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

        return (new Collection($data))->downloadExcel('payrollVariations.xlsx');
    }

}
