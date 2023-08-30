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
        try {
            return $this -> crearPersona($request);
        }
        catch (\Illuminate\Database\QueryException $th) {
            DB::rollback();
            echo "<pre>"; echo $th->getMessage();
        }
        catch (\PDOException $th) {
            return response("No tiene permiso",403);

        }
    }

    private function lockTables(){
        DB::raw('LOCK TABLE personas WRITE');
        DB::raw('LOCK TABLE persona_tels WRITE');
    }

    private function crearPersona($request){
        $this -> lockTables();
        DB::beginTransaction();

        $persona = $this -> insertarPersona($request);
        $this -> agregarTelefono($persona -> id, $request -> post("telefono"));
        $this -> agregarTelefono($persona -> id, $request -> post("otroTelefono"));
            
        DB::commit();
        DB::raw('UNLOCK TABLES');

        return view("resultado",[ "resultado" => "exito" ]);

    }

    private function insertarPersona($request){
        $persona = new Persona();
        $persona -> nombre = $request -> post("nombre");
        $persona -> apellido = $request -> post("apellido");
        $persona -> email = $request -> post("email");
        $persona -> save();
        return $persona;
    }

    private function agregarTelefono($idPersona, $telefono){
        $tel = new PersonaTel();
        $tel -> id_persona  = $idPersona;
        $tel -> telefono = $telefono;
        $tel -> save();

    }

}


