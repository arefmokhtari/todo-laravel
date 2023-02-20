<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Resources\ClassResource;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    //

    public function store(Request $request){
        $validate = Helper::validate($request, Classes::className());

        return Helper::result(Classes::create($validate));
    }

    public function getById(string $id) {
        return Helper::result(new ClassResource(Classes::query()->with(['students'])->findOrFail($id)), ['messageError' => 'not found', 'statusError' => 404]);
    }
    public function addStudent(Request $request){
        $validate = Helper::validateAddClass($request);

        $class = Classes::query()->findOrFail($validate['class_id']);

        $class?->students()->attach($validate['student_id']);

        return Helper::result(null , [ 'messageError' => empty($class)?'not found':null, 'ok' => !empty($class), 'statusError' => 404]);
    }

    public function getStudentByClassId(string $classId){
        return Helper::result(Classes::query()->with(['students'])->findOrFail($classId)?->students?->all());
    }
}
