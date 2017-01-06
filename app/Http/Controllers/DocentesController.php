<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cursos_docentes;
use App\Model\Course_name;
use App\Http\Requests;
use DB;

class DocentesController extends Controller
{
      public function docentes() {
        $clasifica = DB::select("select  distinct(c.categoria)
                                from course_name a, curso_categoria b, categorias c
                                where a.id = b.id_curso 
                                and  b.id_categoria = c.id
                                and a.course_id is not null 
                                and trim(a.course_id)!='' and a.activo=1 order by categoria asc");
        $cursosTodos = Cursos_docentes::whereHas('Course_name', function($query){
			$query->where('activo', '=', 1);
		})->get();
        return view('welcome')->with('cursos', $cursosTodos)->with('clasifica', $clasifica);
    }
}
