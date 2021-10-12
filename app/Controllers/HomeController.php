<?php

namespace App\Controllers;

use App\Models\AlbumModel;

class HomeController extends BaseController
{
  /**
   * Resolve the base request and return a page
   * @param string name of page
   * @return view return a view
   */
  public function index($page = 'index'): void
  {
    if (!is_file(APPPATH . '/Views/' . $page . '.php')) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $dataHeader['title'] = ucfirst($page);
    echo view($page, $dataHeader);
    echo view('templates/footer');
  }
  /**
   * Show the dashboard page and Artists data
   * @param void
   * @return view return the dashboard view
   */
  public function dashboard()
  {
    // Pass the data artist to dashboard and set Title
    $dataHeader['title'] = 'Dashboard';
    $artistList = $this->getArtistList();

    // Get the album list
    $albums = new AlbumModel();
    $albumsList = $albums->getAlbums();

    // Set the Artist on array albumsList
    for ($i = 0; $i < count($albumsList); $i++) { 
      foreach ($artistList as $artist) {
        if (intval($albumsList[$i]['artist_id']) === $artist['id']) {
          $albumsList[$i]['artist_name'] = $artist['name'];
        }
      }
    }
    // Pass the list to view
    $dataBody['albumsList'] = $albumsList;

    echo view('templates/header', $dataHeader);
    echo view('dashboard', $dataBody);
    echo view('templates/footer');
  }
  /**
   * Retrive a list of Artist from API
   * @param void
   * @return array a iterabelarray of Artist
   */
  public function getArtistList(): array
  {
    /*
         * Init the cURL service to retrive the json list of artists
         * need to set:
         * URL: https://moat.ai/api/task/
         * Header: Basic: ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ==
         */

    $client = service('curlrequest');

    $getData = $client->get("https://www.moat.ai/api/task/", [
      "headers" => [
        "Basic" => "ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ=="
      ]
    ]);
    // Convert the JSON response to PHP Array
    $jsonData = json_decode($getData->getBody(), true);

    // In this part the [0] knot from JSON is removed
    // to iterate into a array
    $artistList = [];
    foreach ($jsonData as $json) {
      array_push($artistList, $json[0]);
    };

    return $artistList;
  }
}
