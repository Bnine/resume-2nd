<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use App\Dto\UserProfile\UserProfileDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserProfile\UserProfileService;
use Illuminate\Support\Facades\Log;
use \Exception;

class ProfileController extends Controller
{
    public function __construct()
    {

    }

    public function index(UserProfileService $userProfileService)
    {   
        try {
            $dto = new UserProfileDto(auth()->id(), Lang::getLocale());

            return response()->json([
                'status' => 'successful',
                'message' => 'your request was successful',
                'data' => $userProfileService->getUserProfileData($dto),
            ]);
        } catch (Exception $e) {
            Log::error('Exception occurred : '.json_encode($e->getMessage()));
            return response()->json([
                'status' => 'failure',
                'message' => 'service available',
                'data' => null
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
