<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upFile(Request $request){
        if($request -> hasFile('file')){ //Validar que el archivo viene dentro de la request
            $file = $request -> file('file');//Se obtiene el archivo como tal
            $filename = $file->getClientOriginalName(); //Se obtiene el nombre original del archivo

            $filename = pathinfo($file, PATHINFO_FILENAME); //Obtener nombre sin extensión
            $name_file = str_replace(' ', '_', $filename);

            $extension = $file -> getClientOriginalExtension(); //Obtener la extensión del archivo

            $saveName = $name_file.'.'.$extension; //Nombre formateado

            $file -> move(public_path('Files/'), $saveName); //Guardar el archivo en la carpeta public

            return response() -> json([
                'Mensaje' => 'El archivo se ha subido satisfactoriamente',
                'FileName' => $saveName
            ]);
        }else{
            return response() -> json([ 'Mensaje' => 'No ha sido posible subir el archivo']);
        }
    }

    public function deleteFile(Request $request){
        $file = $request -> file;

        if(unlink('Files/php3WsQmN.pdf')){
            return response() -> json([
                'Mensaje' => 'El archivo ha sido eliminado',
                'FileName' => $file
            ]);
        }
    }
}
