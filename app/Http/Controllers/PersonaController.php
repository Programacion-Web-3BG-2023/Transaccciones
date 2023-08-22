<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\PersonaTel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


class PersonaController extends Controller
{
    public function Crear(Request $request){


        $persona = new Persona();
        $personaTel = new PersonaTel;
        $otraPersonaTel = new PersonaTel;

        try {
            DB::raw('LOCK TABLE personas WRITE');
            DB::raw('LOCK TABLE persona_tels WRITE');
            DB::beginTransaction();

            $persona -> nombre = $request -> post("nombre");
            $persona -> apellido = $request -> post("apellido");
            $persona -> email = $request -> post("email");
            $persona -> save();

            $personaTel -> id_persona  = $persona -> id;
            $personaTel -> telefono = $request -> post("telefono");

            $otraPersonaTel -> id_persona  = $persona -> id;
            $otraPersonaTel -> telefono = $request -> post("otroTelefono");


            $personaTel -> save();
            $otraPersonaTel -> save();
            DB::commit();
            DB::raw('UNLOCK TABLES');

            return view("resultado",[ "resultado" => "exito" ]);

        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            echo "<pre>"; echo $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("No tiene permiso",403);

        }


    }

}


