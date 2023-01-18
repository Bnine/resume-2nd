<?php

namespace App\Http\Controllers;

use App\Dto\UserProject\UserProjectDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Requests\Headers\AcceptLanguage;
use App\Services\UserProject\UserProjectService;
use Illuminate\Support\Facades\Log;
use \Exception;

class ProjectController extends Controller
{
    public function __construct()
    {

    }

    public function index(UserProjectService $userProjectService, Request $request)
    {   
        try {
            $acceptLanguage = new AcceptLanguage($request->header('Accept-Language', 'ko'));

            $dto = new UserProjectDto(auth()->id(), $acceptLanguage->getAcceptedLanguage());

            return response()->json([
                'status' => 'successful',
                'data' => $userProjectService->getUserProjectData($dto),
            ]);
        } catch (Exception $e) {
            Log::error('Exception occurred : '.json_encode($e->getMessage()));
            return response()->json([
                'status' => 'failure',
                'msg' => 'service available',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
