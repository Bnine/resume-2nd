<?php

namespace App\Http\Controllers;

use \Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SendmailPostRequest;
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
            $request->validated();

            $dto = new SendingEmailDto($request->emailAddress, $request->subject, $request->name, $request->content);

            $sendingEmailService->send($dto);

            return response()->json([
                'status' => 'successful',
                'message' => 'your request was successful',
                'data' => null,
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
