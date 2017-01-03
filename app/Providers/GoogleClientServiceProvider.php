<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleClientServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path().'/resources/assets/service_account.json');

        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();

        $client->addScope(\Google_Service_Calendar::CALENDAR_READONLY);

        $client->setSubject('bhppanel@gmail.com');

        // repeat this block for as many Google_Services_* as you like
        // don't forget to add scopes for other services.
        $this->app->singleton(\Google_Service_Calendar::class, function ($app) use ($client) {
            return new \Google_Service_Calendar($client);
        });
    }
}
