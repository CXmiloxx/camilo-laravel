<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return response()->json(
            User::all()
                ->map(
                    function ($user) {
                        return [
                            'id' => $user->id,
                            'nombre' => $user->name,
                            'email' => $user->email,
                            
                        ];
                    }
                )
        );
    }
}
