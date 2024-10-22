<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ControllerCliente extends Controller
{
    public function registrarClientes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:clientes',
            'password' => 'required|string|min:5',
            'telefono' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Cliente::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
        ]);

        if($user){
            return response()->json(['message' => 'Usuario registrado correctamente', 'cliente' => $user], 201);
        }
        return response()->json(['message' => 'Error al crear el cliente'], 500);
    }

    public function lista()
    {
        $clientes = Cliente::all()->map(function ($cliente) {
            return [
                'id' => $cliente->id,
                'nombre' => $cliente->nombre,
                'correo' => $cliente->correo,
                'telefono' => $cliente->telefono,
                'password' => $cliente->password,
            ];
        });

            return response()->json([
                'clientes' => $clientes,
            ]);
    }

    public function cliente($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        return response()->json([
            'id' => $cliente->id,
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'telefono' => $cliente->telefono,
            'direccion' => $cliente->direccion,
        ]);
    }

    public function editar($id, Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required','string','email','max:255'],
            'password' => ['required','string','min:5'],
            'telefono' => ['required', 'numeric'],
        ]);

        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->nombre = $request->nombre;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->password = Hash::make($request->password);
        $cliente->save();

        return response()->json(['message' => 'Cliente actualizado correctamente']);
    }
    public function editarEspecifico($id, Request $request)
    {
        if($request -> has ('nombre')){
            $cliente = Cliente::find($id);

            $cliente -> nombre = $request -> nombre;
        }
        if($request -> has ('correo')){
            $cliente -> correo = $request -> correo;
        }
        if($request -> has ('telefono')){
            $cliente -> telefono = $request -> telefono;
        }
        $cliente -> save();
        
        $data = [
            'Mensaje' => 'Cliente Actualizado',
            'Cliente' => $cliente,
            'Estado' => 200
        ];


        return response() -> json($data,200);

    }
    public function eliminar($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado correctamente']);
    }
}
