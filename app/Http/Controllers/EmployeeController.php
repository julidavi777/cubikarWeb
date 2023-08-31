<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EmployeeController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // Obtener empleados normales
    $employees = Employee::all();

    // Obtener empleados cuyos contratos o exámenes médicos expiran en 5 días o menos
    $expiringEmployees = Employee::where(function ($query) {
        $query->whereDate('contract_expiration', '<=', Carbon::now()->addDays(5))
            ->orWhereDate('exam_expiration', '<=', Carbon::now()->addDays(5));
    })->get();

    // Generar el contenido del mensaje
    $examExpiration = "";
    $contractExpiration = "";
    foreach ($expiringEmployees as $employee) {
         if ($employee->contract_expiration <= Carbon::now()->addDays(5)) {
             $contractExpiration .= " El contrato de empleado  $employee->name expira el $employee->contract_expiration \n"; ;
            
        //     // $examExpiration .= "Contrato expira el {$employee->contract_expiration->format('Y/m/d')}\n";
         }
        if ($employee->exam_expiration <= Carbon::now()->addDays(5)) { 
            $examExpiration .= " El examen de empleado  $employee->name expira el $employee->exam_expiration\n"; ;
        } 
/*
        */
    } 
    // return response()->json($expirationMessage);
    // return view('employees.index', compact('employees', 'expirationMessage'));
     return view('employees.index', compact('employees', 'examExpiration', 'contractExpiration'));
    return response()->json($expiringEmployees);
    }

















    public function store(Request $request)
    {
        $data = $request->all();
        $employ =  request()->except('_token');
        if ($request->hasFile('cv_file')) {
            $employ['cv_file'] = $request->file('cv_file')->store('Employees', 'public');
        }
        if ($request->hasFile('medical_exam_file')) {
            $employ['medical_exam_file'] = $request->file('medical_exam_file')->store('Employees', 'public');
        }
        if ($request->hasFile('followup_letter_file')) {
            $employ['followup_letter_file'] = $request->file('followup_letter_file')->store('Employees', 'public');
        }
        if ($request->hasFile('history_file')) {
            $employ['history_file'] = $request->file('history_file')->store('Employees', 'public');
        }
        if ($request->hasFile('study_stands_file')) {
            $employ['study_stands_file'] = $request->file('study_stands_file')->store('Employees', 'public');
        }
        if ($request->hasFile('id_card_file')) {
            $employ['id_card_file'] = $request->file('id_card_file')->store('Employees', 'public');
        }
        if ($request->hasFile('work_certificate_file')) {
            $employ['work_certificate_file'] = $request->file('work_certificate_file')->store('Employees', 'public');
        }
        if ($request->hasFile('military_passbook_file')) {
            $employ['military_passbook_file'] = $request->file('military_passbook_file')->store('Employees', 'public');
        }

        Employee::insert($employ);
        return redirect('employees')->with('msg', 'Empleado Creado Exitosamente!');


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'id_card' => 'required',
            'type_id' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'cv_file' => 'required',
            'medical_exam_file' => 'required',
            'followup_letter_file' => 'required',
            'history_file' => 'required',
            'study_stands_file' => 'required',
            'id_card_file' => 'required',
            'work_certificate_file' => 'required',
            'military_passbook_file' => 'required'
        ]);
    }

    public function create()
    {
        return view('employees.create');
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $idEmployee
     * @return \Illuminate\Http\Response
    
     */

    public function edit(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $formFields = [
            'name' => 'required|string|max:80',
            'surname' => 'required|string|max:80',
            'id_card'=>'required|string',
            'type_id'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required',
            'email'=>'required|email',
            'position'=>'required|string',
            'cv_file'=>'required|string',
            'medical_exam_file'=>'required|string',
            'followup_letter_file'=>'required|string',
            'history_file'=>'required|string',
            'study_stands_file'=>'required|string',
            'id_card_file'=>'required|string',
            'work_certificate_file'=>'required|string',
            'military_passbook_file'=>'required|string',
            'exam_expiration'=>'required|date',
            'contract_expiration'=>'required|date'
        ];

        $error = [
            'name.required' => 'El nombre es requerido, no debe contener mas de 80 caracteres',
            'surname.required' => 'El apellido es requerido y no debe ser mayor a 80 caracteres',
            'id_card'=>'El id_card es requerido',
            'type_id'=>'El type_id es requerido',
            'address'=>'El address es requerido',
            'phone'=>'El phone es requerido',
            'email'=>'El email es requerido',
            'position'=>'El position es requerido',
            'cv_file'=>'El cv_file es requerido',
            'medical_exam_file'=>'El medical_exam_file es requerido',
            'followup_letter_file'=>'El followup_letter_file es requerido',
            'history_file'=>'El history_file es requerido',
            'study_stands_file'=>'El study_stands_file es requerido',
            'id_card_file'=>'El id_card_file es requerido',
            'work_certificate_file'=>'El work_certificate_file es requerido',
            'military_passbook_file'=>'El military_passbook_file es requerido',
            'exam_expiration'=>'El exam_expiration es requerido',
            'contract_expiration'=>'El contract_expiration es requerido'
           
        ];

        $this->validate($request, $formFields, $error);
        $employee = request()->except(['_token', '_method']);

        // if ($request->hasFile('front')) {
        //     $formFields = ['front' => 'required|max:8000|mimes:jpg,png,jpeg,webp',];
        //     $error = ['required' => 'La portada es requerida'];

        //     $employees = Employee::findOrFail($id);
        //     Storage::delete(['public/', $employees->front]);
        //     $employee['front'] = $request->file('front')->store('uploads', 'public');
        // }


        Employee::where('id', '=', $id)->update($employee);
        $employees = Employee::findOrFail($id);
        return redirect('employees')->with('msg', 'El empleado se ha editado correctamente');
    }

    //         /**
    //      * Remove the specified resource from storage.
    //      *
    //      * @param  \App\Models\Employee  $employee_id
    //      * @return \Illuminate\Http\Response
    //      */
    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        $employee->delete();
        return redirect('employees')->with('msg', 'El empleado se ha eliminado correctamente');

    }
}
