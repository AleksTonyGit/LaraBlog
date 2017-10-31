<?php

namespace App\Models;

use\Esensi\Model\Model;

class Topic extends Model
{
  protected $primaryKey='id';
  protected $table='topics';
  protected $fillable=['topicname','created_at','updated_at'];
  protected $rules=['topicname'=>['required','min:5','max:128']
  ];
}
