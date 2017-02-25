<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table        =   'order';
    protected $primaryKey   =   'id';
    public $timestamps   =   false;
    protected $guarded  =   [];

    public function add($data)
    {
        self::create($data);
    }
}
