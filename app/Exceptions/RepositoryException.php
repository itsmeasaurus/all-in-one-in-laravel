<?php

namespace App\Exceptions;

class RepositoryException extends GeneralJsonException
{
    public function report()
    {
        // Send an email to the administrator
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage()
        ], $this->code ?? 500);
    }
}

