<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Object_;

class TwittweConnection
{
  protected $totalTweet = [];

  /**
   * Undocumented function
   *
   * @param array $data
   * @param string $seleccionaCategorias
   * @return array
   */
  protected function callApi($data = [], $seleccionaCategorias = 'tweets')
  {
    $data = array_replace_recursive([
      'hastag' => 'farina',
      'idTweet' => 0,
      'limit' => 15
    ], $data);
    try {
      $url = $seleccionaCategorias === 'tweets' ? "https://api.twitter.com/2/tweets/search/recent?query=%23{$data['hastag']}&max_results={$data['limit']}" :
        "https://api.twitter.com/2/tweets/{$data['idTweet']}/liking_users?max_results=100";

      $response  = Http::withToken(config('constants.twitter.BEARER_TOKEN_TWITTER'))->get($url)->json();
      return $response['data'];
    } catch (Exception $e) {
      $e->getMessage();
      return;
    }
  }

  public function getData($config = [])
  {

    $config = array_replace_recursive(
      [
        'hastag' => 'farina',
        'likes' => true
      ],
      $config
    );
    $totalTweet = [];
    $getTweets = $this->callApi();

    if ($getTweets) {
      foreach ($getTweets as $id => $tweet) {
        $totalTweet[$id]['text'] = $tweet['text'];
        $totalTweet[$id]['id_tweet'] = $tweet['id'];

        $totalTweet[$id]['likes'] = !empty($this->callApi(['idTweet' => $totalTweet[$id]['id_tweet']], 'likes')) ? count($this->callApi(['idTweet' => $totalTweet[$id]['id_tweet']], 'likes')) : 0;
      }
    }
    dump($totalTweet);
    die();


    // return $response->body();
  }
}
