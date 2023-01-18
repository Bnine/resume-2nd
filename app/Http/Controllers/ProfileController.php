<?php

namespace App\Http\Controllers;

use App\Dto\UserProfile\UserProfileDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Requests\Headers\AcceptLanguage;
use App\Services\UserProfile\UserProfileService;
use Illuminate\Support\Facades\Log;
use \Exception;

class ProfileController extends Controller
{
    public function __construct()
    {

    }

    public function index(UserProfileService $userProfileService, Request $request)
    {   
        try {
            $acceptLanguage = new AcceptLanguage($request->header('Accept-Language', 'ko'));

            $dto = new UserProfileDto(auth()->id(), $acceptLanguage->getAcceptedLanguage());

            return response()->json([
                'status' => 'successful',
                'data' => $userProfileService->getUserProfileData($dto),
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
