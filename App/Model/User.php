<?php

namespace App\Model;

use Core\Model;

Class User extends Model {
    protected $table = "user";
    protected $primaryKey = "id";

    protected $fillable = [
        "Name",
        "Email",
        "Password"
    ];
}