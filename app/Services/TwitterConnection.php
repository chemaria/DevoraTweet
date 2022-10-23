<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;


class TwitterConnection
{

  /**
   * Llamada a la API de Twitter
   *
   * @param array $data [hastag idTweet limitTweets limitLikes categoria]
   *
   * @return array
   */
  protected function callApi($data = [])
  {
    $data = array_replace_recursive([
      'hastag' => 'farina',
      'idTweet' => 0,
      'limitTweets' => 100,
      'limitLikes' => 100,
      'categoria' => 'tweets'
    ], $data);
    try {
      $url = $data['categoria'] === 'tweets' ? "https://api.twitter.com/2/tweets/search/recent?query=%23{$data['hastag']}&max_results={$data['limitTweets']}&tweet.fields=created_at" :
        "https://api.twitter.com/2/tweets/{$data['idTweet']}/liking_users?max_results={$data['limitLikes']}";

      $response  = Http::withToken(config('constants.twitter.BEARER_TOKEN_TWITTER'))->get($url)->json();

      return $response['data'];
    } catch (Exception $e) {
      $e->getMessage();

      return;
    }
  }
  /**
   * Extrae datos necesarios e informa array
   *
   * @param array $config
   * @return array 
   */
  public function getData($config = [])
  {

    $totalTweet = [];
    $getTweets = $this->callApi();

    if ($getTweets) {
      foreach ($getTweets as $id => $tweet) {
        $totalTweet[$id]['text'] = $tweet['text'];
        $totalTweet[$id]['id_tweet'] = $tweet['id'];
        $totalTweet[$id]['tweet_created_at'] = Carbon::parse($tweet['created_at'])->setTimezone('Europe/Madrid')->format('Y-m-d H');
        $totalTweet[$id]['likes'] = !empty($this->callApi(['idTweet' => $totalTweet[$id]['id_tweet'], 'categoria' => 'likes'])) ?
          count($this->callApi(['idTweet' => $totalTweet[$id]['id_tweet']], 'likes')) : 0;
      }
    }

    return $totalTweet;
  }
}
