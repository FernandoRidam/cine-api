<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class GenreController extends Controller
{
  public function __construct() {
    $headers = apache_request_headers();
    $language = str_split( $headers['Accept-Language'], 5)[0];

    $this->url = getenv('APP_API_URL');
    $apiKey = getenv('APP_API_KEY');

    $this->restPath = '?api_key='.$apiKey.'&language='.$language;
  }

  public function index() {
    $path = '/genre/movie/list';

    $genres = json_decode( file_get_contents( $this->url.$path.$this->restPath ));

    return response()->json( $genres );
  }
}
