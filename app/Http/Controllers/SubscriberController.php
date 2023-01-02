<?php

namespace App\Http\Controllers;

use App\CommandBus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Traits\ControllerResponse;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Commands\WeatherSubscriber\CreateWeatherSubscriberCommand;
use App\Commands\WeatherSubscriber\UpdateWeatherSubscriberCommand;
use App\Validators\WeatherSubscriber\IdWeatherSubscriberValidator;
use App\Validators\WeatherSubscriber\CreateWeatherSubscriberValidator;
use App\Commands\WeatherSubscriber\DeleteWeatherSubscriberCommand;

class SubscriberController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ControllerResponse;

    public function __construct(
        protected CommandBus $commandBus,
    )
    {
    }

    public function listSubscribers(): JsonResponse
    {
        $weather_subscribers = DB::table('weather_subscribers')->get();

        return $this->jsonResponse($weather_subscribers);
    }
    public function listEmails(): JsonResponse
    {
        $emails = DB::table('emails')->get();

        return $this->jsonResponse($emails);
    }

    public function create(Request $request): JsonResponse
    {
        $command = new CreateWeatherSubscriberCommand($request->city,$request->email,$request->sendingHour);
        if ($errors = (new CreateWeatherSubscriberValidator($command))->errors()) return $this->jsonValidate($errors);
        $record = $this->commandBus->handle($command);

        return $this->JsonResponse($record);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if((new IdWeatherSubscriberValidator())->idDoesNotExist($id)){
            return $this->jsonMissingId();
        }
        $command = new CreateWeatherSubscriberCommand($request->city, $request->email, $request->sedningHours);
        if ($errors = (new CreateWeatherSubscriberValidator($command))->errors()) {
            return $this->jsonValidate($errors);
        }   
        $command = new UpdateWeatherSubscriberCommand($id, $request->city, $request->email, $request->sedningHours, );
        $result = $this->commandBus->handle($command);

        return $this->jsonResponse($result);     
    }

    public function destroy(int $id): JsonResponse
    {
        if((new IdWeatherSubscriberValidator())->idDoesNotExist($id)){
            return $this->jsonMissingId();
        }
        $command = new DeleteWeatherSubscriberCommand($id);
        $this->commandBus->handle($command);


        return $this->jsonDelete();
    }


}
