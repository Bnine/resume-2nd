<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use App\Dto\UserProject\UserProjectDto;
use Illuminate\Http\Response;
use App\Services\UserProject\UserProjectService;
use Illuminate\Support\Facades\Log;
use \Exception;

class ProjectController extends Controller
{
    public function __construct()
    {

    }

    public function index(UserProjectService $userProjectService)
    {
        try {
            $dto = new UserProjectDto(auth()->id(), Lang::getLocale());

            return response()->json([
                'status' => 'successful',
                'message' => 'your request was successful',
                'data' => $userProjectService->getUserProjectData($dto),
            ]);
        } catch (Exception $e) {
            Log::error('Exception occurred : ' . json_encode($e->getMessage()));
            return response()->json([
                'status' => 'failure',
                'message' => 'service available',
                'data' => null
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}