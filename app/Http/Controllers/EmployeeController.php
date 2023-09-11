<?php

namespace App\Http\Controllers;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Previous_jobs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function countEmployee()
    {
        $employee = Employee::query()->where('status', 1)->get();
        $count = count($employee);
        return response()->json(['count' => $count], 200);
    }

    public function storeEmployee(EmployeeRequest $request)
    {
        $validation = $request->validated();
        $employee = Employee::query()->create([

            'name' => $request->name,
            'fatherName' => $request->fatherName,
            'motherName' => $request->motherName,
            'gender' => $request->gender,
            'placeOfBirth' => $request->placeOfBirth,
            'birthDate' => $request->birthDate,
            'nationality' => $request->nationality,
            'idNumber' => $request->idNumber,
            'familyStatus' => $request->familyStatus,
            'husbandName' => $request->husbandName,
            'husbandWork' => $request->husbandWork,
            'childrenNumber' => $request->childrenNumber,
            'address' => $request->address,
            'landPhone' => $request->landPhone,
            'mobilePhone' => $request->mobilePhone,
            'certificate' => $request->certificate,
            'jurisdiction' => $request->jurisdiction,
            'language' => $request->language,
            'computerSkills' => $request->computerSkills,
            'otherSkills' => $request->otherSkills,
            'socialInsurance' => $request->socialInsurance,
            'lastSalaryReceived' => $request->lastSalaryReceived,
            'expectedSalary' => $request->expectedSalary,
            'interview' => $request->interview,
            'workYouWish' => $request->workYouWish,
            'managementNotes' => $request->managementNotes,
        ]);

        $data = $request->json()->all();
        foreach ($data['jobs'] as $job) {
            $newJob = new Previous_jobs();
            $newJob->workPlace = $job['workPlace'];
            $newJob->classesStudied = $job['classesStudied'];
            $newJob->duration = $job['duration'];
            $newJob->work = $job['work'];
            $newJob->employee_id = $employee->id;

            $newJob->save();
        }


//        if ($request->certificate == 1) {
//            $super = Employee::query()->create([
//                'certificate' => $request->certificate,
//
//            ]);
//        }
        return response()->json(["message" => "تمت إضافة الموظف بنجاح"]);
    }

    public function employeeAccept()
    {
        $accept = DB::table('employees as e')
            ->select('e.id', 'e.name', 'e.jurisdiction', 'e.managementNotes')
            ->where('e.status', '=', '1')
            ->orderByDesc('updated_at')
            ->get();
        return response()->json($accept);
    }

    public function employeeArchives()
    {
        $archives = DB::table('employees as e')
            ->select('e.id', 'e.name', 'e.jurisdiction', 'e.managementNotes')
            ->where('e.status', '=', '0')
            ->orderByDesc('updated_at')
            ->get();
        return response()->json($archives);

    }

    public function status(Request $request, $employeeID)
    {
        $employee = Employee::where('id', $employeeID);
        if ($request->status == '1') {
            $employee->update([
                'status' => $request->status,]);
            $response = "تم إضافة الموظف إلى قائمة الموظفين المقبولين";
        } else {
            $response = "حدث خطأ يرجى إعادة المحاولة";

        }

        return response()->json(["message" => "$response"], 200);
    }


    public function showEmployee($employeeId)
    {$info = DB::table('employees as emp')
//            ->join('previous_jobs as pj', 'emp.id', 'pj.employee_id')
        ->where('emp.id', $employeeId)->select(
            'id','name', 'fatherName', 'motherName',
            'gender', 'placeOfBirth', 'birthDate',
            'nationality', 'idNumber', 'familyStatus',
            'husbandName', 'husbandWork', 'childrenNumber',
            'address', 'landPhone', 'mobilePhone',
            'certificate', 'language', 'jurisdiction',
            'computerSkills', 'otherSkills', 'socialInsurance',
            'lastSalaryReceived', 'expectedSalary', 'interview',
            'workYouWish', 'managementNotes')->get();
        $data["data"]=$info;
//
        $job=Previous_jobs::query()->where('employee_id',$info->first()->id)->get();
        $data["job"]=$job;


        return response()->json($data);


//        $Id = Employee::where('id', $employeeId);
//        $employee = $Id->select('id', 'name', 'fatherName',
//            'motherName', 'gender', 'placeOfBirth',
//            'birthDate', 'nationality', 'idNumber',
//            'familyStatus', 'husbandName', 'husbandWork',
//            'childrenNumber', 'address', 'landPhone',
//            'mobilePhone', 'certificate', 'language',
//            'jurisdiction', 'computerSkills', 'otherSkills',
//            'socialInsurance', 'lastSalaryReceived', 'expectedSalary',
//            'interview', 'workYouWish', 'managementNotes')->get()->first();
//        $job = Previous_jobs::query()->where('employee_id', $employee->id)->get();
//        $data["emp"] = $employee;
//        return response()->json($data);

//        $dompdf = new Dompdf();
//        // Load your HTML content into Dompdf
//        $html = "<h1>$employee</h1>";
//        $dompdf->loadHtml($html);
//
//        // (Optional) Set the paper size and orientation
//        $dompdf->setPaper('A4', 'portrait');
//
//        // Render the HTML as PDF
//        $dompdf->render();
//
//        // Output the generated PDF to the browser or save it to a file
//        return $dompdf->stream('document.pdf');
    }


    public function edit(Employee $employee)
    {
        //
    }


    public function update(Request $request, Employee $employee)
    {
        //
    }


    public function destroyEmployee($employeeId)
    {

        $employee = Employee::where('id', $employeeId)->delete();
        if ($employee) {

            return response()->json(["result" => "تم حذف الموظف بنجاح"]);
        } else {
            return response()->json(["result" => "operation failed"]);

        }


        //&& $message->user_id == auth()->id()
//        if (Employee::find($IdMessage) && $message->user_id != auth()->id()) {
//            $response = ['message' => 'unauthorized'];
//        }
    }

//    public function search(Request $request)
//    {
//        $search = $request->input('name');
//        $employee = Employee::query()->where('name', 'LIKE', "%{$search}%")->select('id', 'name', 'jurisdiction', 'managementNotes')->get();
//        return response()->json($employee, 200);
//    }
}
