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
        //
    }

    /**
     * Execute the job. 
     *
     * @return void
     */
    public function handle(TwitterConnection $apiTwitter)
    {
        $tweet = new Tweet();
        $response = $apiTwitter->getData();
        foreach ($response as $data) {
            $tweet->idtweet = $data['id_tweet'];
            $tweet->tweets = $data['text'];
            $tweet->likes = $data['likes'];
        }
    }
}
