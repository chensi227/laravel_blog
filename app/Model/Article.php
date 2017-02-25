<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table        =   'article';
    protected $primaryKey   =   'id';
    public $timestamps   =   false;
    protected $guarded  =   [];
}
