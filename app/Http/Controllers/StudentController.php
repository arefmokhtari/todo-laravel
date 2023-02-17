<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Helper\Helper;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function store(Request $request){
        $validate = Helper::validate($request, Student::className());

        return Helper::result(Student::create($validate));
    }

    public function getById(string $id) {
        return Helper::result(Student::query()->find($id), ['messageError' => 'not found', 'statusError' => 404]);
    }

    public function getClass(string $studentId){
        return Helper::result(Student::query()->with(['classes'])->find($studentId)?->classes?->all());
    }
}
