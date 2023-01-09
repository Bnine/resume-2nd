<?php

namespace App\Http\Controllers;

use App\Dto\UserProfile\UserProfileDto;
use Illuminate\Http\Request;
use App\Helpers\Requests\Headers\AcceptLanguage;
use App\Services\UserProfile\UserProfileService;
use \Exception;

use function PHPUnit\Framework\throwException;

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

            //throw new Exception('ttt');

            return response()->json([
                'status' => 'successful',
                'data' => $userProfileService->getUserProfileData($dto),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failure',
                'msg' => $e->getMessage(),
            ], 400);
        }
    }

    /*
    public function index(Request $request)
    {
        return response()->json([
            'id' => auth()->id(),
            'ss' => $request->header('Accept-Language', 'ko'),
            //'data' => UserProfile::where('user_id', auth()->id())->get(),
            'data' => User::find(1)->userprofile,
        ]);
    }
    */

    /*
    public function index(Request $request)
    {
        $acceptLanguage = new AcceptLanguage($request->header('Accept-Language', 'ko'));

        return response()->json([
            'id' => auth()->id(),
            'ss' => $acceptLanguage->getAcceptedLanguage(),
            //'data' => UserProfile::where('user_id', auth()->id())->get(),
            'data' => User::find(1)->userprofile,
        ]);
    }
    */
}
