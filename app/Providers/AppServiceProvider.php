<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Google\Auth\ApplicationDefaultCredentials;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\Middleware\AuthTokenMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}


class FCMService
{
    protected $serverKey;

    public function __construct()
    {
        $this->serverKey = config('services.fcm.server_key');
    }

    public function sendToTopic($topic, $title, $body, $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $payload = [
            'to' => '/topics/' . $topic,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
            ],
            'data' => $data,
        ];

        return Http::withToken($this->serverKey)
            ->post($url, $payload)
            ->json();
    }
}

class FirebaseTokenService
{
    protected $credentialsPath;

    public function __construct()
    {
        $this->credentialsPath = storage_path('app/firebase/di-las-ee43cf958014.json');
    }

    public function generateAccessToken()
    {
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        // Correct usage: pass scopes and path to JSON file
        $credentials = new ServiceAccountCredentials($scopes, $this->credentialsPath);

        $token = $credentials->fetchAuthToken();

        return $token['access_token'] ?? null;
    }
}


