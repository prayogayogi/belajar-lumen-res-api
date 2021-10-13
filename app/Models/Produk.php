<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Produk extends Model
{
  protected $table = 'produk';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $fillable = [
    'nama', 'harga', 'warna', 'kondisi', 'deskripsi'
  ];
}
