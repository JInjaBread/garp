<?php
namespace App\Models;

use CodeIgniter\Model;

class Studentmodels extends Model
{
  protected $table = 'student';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'name',
    'email',
    'phone',
    'course'
  ];
}
?>
