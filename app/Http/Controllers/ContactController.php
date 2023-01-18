<?php

namespace App\Http\Controllers;

use \Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SendmailPostRequest;
use App\Helpers\Requests\Headers\AcceptLanguage;
use App\Services\Contact\SendingEmailService;
use App\Dto\Contact\SendingEmailDto;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function sendEmail(SendingEmailService $sendingEmailService, SendmailPostRequest $request)
    {   
        try {
            $acceptLanguage = new AcceptLanguage($request->header('Accept-Language', 'ko'));

            $request->validated();

            $dto = new SendingEmailDto($request->emailAddress, $request->subject, $request->name, $request->content);

            $sendingEmailService->send($dto);

            return response()->json([
                'status' => 'successful',
            ]);
        } catch (Exception $e) {
            Log::error('Exception occurred : '.json_encode($e->getMessage()));
            return response()->json([
                'status' => 'failure',
                'message' => 'service available',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
