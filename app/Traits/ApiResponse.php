<?php
namespace App\Traits;
use Illuminate\Http\JsonResponse;
trait ApiResponse {
    protected function successResponse($data, $message = null, $code = 200): JsonResponse {
        return response()->json(['success' => true, 'message' => $message, 'data' => $data], $code);
    }
    protected function errorResponse($message, $code = 400): JsonResponse {
        return response()->json(['success' => false, 'message' => $message, 'data' => null], $code);
    }
    protected function updatedResponse($data, $message = 'Resource updated successfully'): JsonResponse {
        return $this->successResponse($data, $message);
    }
    protected function deletedResponse($message = 'Resource deleted successfully'): JsonResponse {
        return $this->successResponse(null, $message);
    }
}