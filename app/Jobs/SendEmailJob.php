<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationCreated;
use App\Models\User;
use App\Models\Application;

class SendEmailJob implements ShouldQueue
{
    use Queueable;

    public Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(): void
    {
        $manager = User::first();

        Mail::to($manager)->send(new ApplicationCreated($this->app));
    }
}
