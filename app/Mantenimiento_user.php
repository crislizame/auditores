<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento_user extends Model
{
    protected $primaryKey = 'idmantenimiento_users';
    protected $guarded = [
        'created_at', 'updated_at'
    ];
}
