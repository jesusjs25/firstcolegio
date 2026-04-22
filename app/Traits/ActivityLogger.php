<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait ActivityLogger
{
    /**
     * Registra una actividad en la base de datos.
     */
    public function logActivity($action, $model, $description)
    {
        // Usamos Auth::user()->getAuthIdentifier() o simplemente Auth::id() 
        // pero con un chequeo previo para que el editor esté feliz.
        $userId = Auth::check() ? Auth::id() : null;

        Activity::create([
            'user_id'     => $userId,
            'action'      => $action,
            'model'       => $model,
            'description' => $description,
        ]);
    }
}