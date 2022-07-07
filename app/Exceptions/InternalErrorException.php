<?php

namespace App\Exceptions;

use Exception;

class InternalErrorException extends Exception
{
    public function render($request)
    {
        return response()->json(['message' => "Ocorreu um erro interno, caso continue entre em contato com administrador."], 500);
    }
}
