<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\TwitterConnection;
use App\Models\Tweet;
use Illuminate\Support\Facades\Storage;

class MakeTwitterApiRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->handle();
    }

    /**
     * Execute the job. 
     *
     * @return void
     */
    public function handle()
    {
        $apiTwitter = new TwitterConnection();

        $response = $apiTwitter->getData();
        foreach ($response as $data) {
            $tweet = new Tweet();
            $tweet->idtweet = (int)$data['id_tweet'];
            $tweet->tweets = $data['text'];
            $tweet->likes = (int)$data['likes'];
            $tweet->save();
        }
        Storage::append("prueba.json", json_encode($response));
    }
}
