<?php

namespace App\Models;

use\Esensi\Model\Model;

class Block extends Model
{
  protected $primaryKey='id';
  protected $table='blocks';
  protected $fillable=['title','topicid', 'content','imagesPath','created_at','updated_at'];
  protected $rules=[
                      'title'=>['required','max:100'],
                      'topicid'=>['required'],
                      'content'=>['required']
                    ];
}
