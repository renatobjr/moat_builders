<?php

namespace App\Models;
use CodeIgniter\Model;

class AlbumModel extends Model 
{
  // Set table model name and other stuffs
  protected $table                = 'albums';
  protected $primaryKey           = 'id';
  protected $useAutoIncrement     = true;
  protected $protectFields        = true;
  // Allowed fields 
  protected $allowedFields = [
    'artist_id',
    'album_title',
    'album_year'
  ];

  public function getAlbums($id = false)
  {
    if ($id === false) {
      return $this->findAll();
    }

    return $this->asArray()
                ->where(['id' => $id])
                ->first();
  }
}