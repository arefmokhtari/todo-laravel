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

    public function addToClass(Request $request){
        $validate = Helper::validateAddClass($request);

        $student = Student::query()->find($validate['student_id']);

        $student?->classes()->attach($validate['class_id']);

        return Helper::result(null , [ 'messageError' => empty($student)?'not found':null, 'ok' => !empty($student), 'statusError' => 404]);
    }
    public function getClass(string $id){
        return Helper::result(Student::query()->find($id)?->classes?->all());
    }
}
