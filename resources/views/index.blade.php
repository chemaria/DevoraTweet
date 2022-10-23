@extends('layouts.principal')
@section('principal')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">IdTweet</th>
      <th scope="col">Tweet</th>
      <th scope="col">Likes</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($tweets as $id => $tweet)
      <tr>
        <th scope="row">{{$id}}</th>
        <td>{{$tweet['idtweet']}}</td>
        <td>{{$tweet['tweets']}}</td>
        <td>{{$tweet['likes']}}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection