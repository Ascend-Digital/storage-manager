<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Http\Controllers\Api;

use AscendDigital\StorageManager\Http\Requests\DeleteFile;
use AscendDigital\StorageManager\Http\Requests\UploadFile;

use AscendDigital\StorageManager\StorageManagerFacade as StorageManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * @since 1.0.0
 */
class FileUploadController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  UploadFile  $request
     *
     * @return JsonResponse
     */
    public function store(UploadFile $request): JsonResponse
    {
        $file = StorageManager::uploadFile($request->file, $request->tag);

        if (is_null($file)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unexpected error occurred, unable to process request',
            ], 500);
        }

        return response()->json([
                'status' => 'success',
                'data' => $file,
                'message' => 'File saved successfully',
            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteFile  $request
     *
     * @return JsonResponse
     */
    public function destroy(DeleteFile $request): JsonResponse
    {
        if (StorageManager::deleteFile($request->key)) {
            return response()->json([
                'status' => 'success',
                'message' => 'File deleted successfully',
                ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unexpected error occurred, unable to process request',
            ], 500);
        }
    }
}
