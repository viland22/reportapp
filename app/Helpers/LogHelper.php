<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function record(string $tipe, string $action, ?string $model = null, $model_id = null, $message = null, $data = null)
    {
        Log::create([
            'user_id' => Auth::id(),
            'tipe' => $tipe,
            'action' => $action,
            'model' => $model,
            'model_id' => $model_id,
            'message' => $message,
            'data' => is_array($data) ? $data : request()->all(),
            'url' => request()->fullUrl(),
        ]);
    }
}
