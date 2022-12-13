<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubscriberController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function listSubscribers(): JsonResponse
    {
        $weather_subcribers = DB::table('weather_subcribers')->get();

        return $this->jsonResponse($weather_subcribers);
    }
    public function listEmails(): JsonResponse
    {
        $emails = DB::table('emails')->get();

        return $this->jsonResponse($emails);
    }



}
