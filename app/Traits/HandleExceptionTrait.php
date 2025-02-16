<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait HandleExceptionTrait
{
    public function handleException(\Throwable $th, string $customMessage = 'Đã có lỗi xảy ra.')
    {
        Log::error(__CLASS__ . '@' . __FUNCTION__, [
            'line' => $th->getLine(),
            'message' => $th->getMessage(),
        ]);

        if ($th instanceof ModelNotFoundException) {
            return response()->json([
                'message' => $customMessage
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Lỗi máy chủ nội bộ. Vui lòng thử lại sau.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
