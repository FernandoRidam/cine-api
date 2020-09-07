<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  public function __construct() {
    $headers = apache_request_headers();

    $this->url = getenv('APP_API_URL');
    $apiKey = getenv('APP_API_KEY');

    $language = str_split( $headers['Accept-Language'], 5)[0];

    $this->restPath = '?api_key='.$apiKey.'&language='.$language;
  }

  public function search( $query ) {
    $query = str_replace(' ', '-', $query );
    $path = '/search/movie';

    $movies = json_decode( file_get_contents( $this->url.$path.$this->restPath.'&query='.$query ));

    return response()->json( $movies );
  }

  public function trending() {
    $path = '/movie/upcoming';

    $movies = json_decode( file_get_contents( $this->url.$path.$this->restPath ));

    return response()->json( $movies );
  }

  public function discover() {
    $path = '/discover/movie';

    $movies = json_decode( file_get_contents( $this->url.$path.$this->restPath ));

    return response()->json( $movies );
  }

  public function show( $id ) {
    $path = '/movie/';

    $movie = json_decode( file_get_contents( $this->url.$path.$id.$this->restPath ));

    return response()->json( $movie );
  }
}
