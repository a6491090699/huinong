<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    use Notifiable;

    protected $guarded= [];

    public function roleinfo()
    {
        return $this->belongsTo('App\Model\AdminRole' , 'role_id');
    }




}
