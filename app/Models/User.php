<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'new_users'; 

    protected $fillable = ['name', 'surname', 'email', 'country', 'province', 'district'];
}