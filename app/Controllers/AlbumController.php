<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Controllers\HomeController;

class AlbumController extends BaseController
{
  /**
   * Render the form to save new albums
   * @param void
   * @return view return form view 
   */
  public function newAlbum(): void
  {
    // Get a instance of artist list
    $artistList = new HomeController();

    // Set title and list of artists
    $dataHeader['title'] = 'New album';
    $dataBody['artistList'] = $artistList->getArtistList();
    
    // render page to save new albumns
    echo view('templates/header', $dataHeader);
    echo view('forms/form_album', $dataBody);
    echo view('templates/footer');
  }

  /**
   * Validate the form values and persist data in DB
   * @param void
   * @return view dashboard view if the validate is TRUE or the form with errors case FALSE
   */
  public function saveAlbum()
  {
    // Loading helpers
    helper(['form', 'url']);

    // Get a instance of artist list
    $artistList = new HomeController();

    // Pass the data artist to dashboard
    $dataHeader['title'] = 'New Album';
    $dataBody['artistList'] = $artistList->getArtistList();

    if ($this->request->getMethod() === 'post' && $this->validate([
      'artist_id'     => 'required',
      'album_title'   => 'required',
      'album_year'    => 'required|numeric'
    ])) {

      // Set the model
      $album = new AlbumModel();

      // Collecting data
      $data = [
        'artist_id'   => $this->request->getPost('artist_id'),
        'album_title' => $this->request->getPost('album_title'),
        'album_year'  => $this->request->getPost('album_year')
      ];

      if (!$this->request->getPost('id')) {
        $album->save($data);
        $flashResponse = 'The Album ' . $this->request->getPost('album_title') . ' has saved!';  
      } else {
        $album->update($this->request->getPost('id'),$data);
        $flashResponse = 'The Album ' . $this->request->getPost('album_title') . ' has updated!';
      }

      // Set a flashdata and redirect
      session()->setFlashdata('success',$flashResponse);
      return redirect()->to(base_url('dashboard'));

    } else {
      echo view('templates/header', $dataHeader);
      echo view('forms/form_album', $dataBody, [
        'validation' => $this->validator
      ]);
      echo view('templates/footer');
    }
  }

  /**
   * Allow edit a album
   * @param id album id to retrive info about the album
   * @return view return a form album with date to edit
   */
  public function editAlbum($id = null): void
  {
    // Verify the id 
    if ($id === false) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }

    // Loading helpers
    helper(['form', 'url']);

    // Get a instance of artist list
    $artistList = new HomeController();

    // Pass the data artist to dashboard and set Title
    $dataHeader['title'] = 'Edit Album';
    $dataBody['artistList'] = $artistList->getArtistList();

    // Get the album data in DB
    $album = new AlbumModel();
    $dataBody['dataAlbum'] = $album->find($id);

    echo view('templates/header', $dataHeader);
    echo view('forms/form_album', $dataBody);
    echo view('templates/footer');
  }
  /**
   * Allow the admin user to remove an Album
   * @param id album to remove
   * @return view return to the dashboard showing the error/success mensage
   */
  public function deleteAlbum($id = null)
  {
    // Get role for user and verify if is possible delete the album
    $role = $_SESSION['role'];
    if ($role === '0') {
      // Verify the id
      if ($id === false) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
      }

      // Delete an Album
      $album = new AlbumModel();

      $album->delete(['id' => $id]);

      // Set a flashdata and redirect
      session()->setFlashdata('success','The Album has deleted!');
    } else {
      // Set a flashdata and redirect
      session()->setFlashdata('error','Only admins can delete Albums. Plese contact the Support for more info.');
    }
    return redirect()->to(base_url('dashboard'));
  }
}