<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
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
        $employee = Employee::all();
        $count = count($employee);
        return response()->json(['count' => $count], 200);
    }

    public function store(EmployeeRequest $request)
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


//        if ($request->certificate == 1) {
//            $super = Employee::query()->create([
//                'certificate' => $request->certificate,
//
//            ]);
//        }
        return response()->json($employee);


    }

    public function employeeAccept()
    {
        $accept = DB::table('employees as e')
            ->select('e.id', 'e.name', 'e.jurisdiction', 'e.managementNotes')
            ->where('e.status', '=', '1')
            ->get();
        return response()->json($accept);

    }

    public function employeeArchives()
    {
        $archives = DB::table('employees as e')
            ->select('e.id', 'e.name', 'e.jurisdiction', 'e.managementNotes')
            ->where('e.status', '=', '0')
            ->get();
        return response()->json($archives);

    }

    public function status(Request $request, $employeeID)
    {
        $employee = Employee::where('id', $employeeID);
        if ($request->status == '1') {
            $employee->update([
                'status' => $request->status,]);
            $response = 'the employee is accept';
        }

        return response()->json($response);
    }


    public function show(Employee $employee)
    {
        //
    }


    public function edit(Employee $employee)
    {
        //
    }


    public function update(Request $request, Employee $employee)
    {
        //
    }


    public function destroy($employeeId)
    {

        $employee = Employee::where('id',$employeeId)->delete();
        if ($employee) {

            return response()->json(["result"=>"employee has been deleted"]);
        } else {
            return response()->json(["result"=>"operation failed"]);

        }


        //&& $message->user_id == auth()->id()
//        if (Employee::find($IdMessage) && $message->user_id != auth()->id()) {
//            $response = ['message' => 'unauthorized'];
//        }
    }

    public function search(Request $request)
    {
        $search = $request->input('name');
        $employee = Employee::query()->where('name', 'LIKE', "%{$search}%")->select('id', 'name', 'jurisdiction', 'managementNotes')->get();
        return response()->json($employee, 200);
    }
}
