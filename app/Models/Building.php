<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    const ACTIVE = 1;
    const DELETED = 5;
    protected $table = 'buildings';
}
