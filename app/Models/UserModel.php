<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
   // Set table model name and other stuffs
  protected $table            = 'users';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $protectFields    = true;
  // Allowed fields
  protected $allowedFields = [
    'fullname',
    'username',
    'password',
    'role'
  ];
}
