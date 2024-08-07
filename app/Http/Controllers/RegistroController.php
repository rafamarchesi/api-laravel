<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

/**
 * @OA\Info(title="My API", version="1.0")
 */
class RegistroController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/registros",
     *     summary="Listar todos os registros",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de registros"
     *     )
     * )
     */
    public function index()
    {
        $registros = Registro::all();
        return response()->json($registros);
    }

    /**
     * @OA\Get(
     *     path="/api/registros/{id}",
     *     summary="Obter um registro específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do registro",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do registro"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $registro = Registro::find($id);
        if ($registro) {
            return response()->json($registro);
        }
        return response()->json(['message' => 'Registro não encontrado'], 404);
    }
}
