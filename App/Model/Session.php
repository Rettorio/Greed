<?php

namespace App\Model;

use Core\Model;

Class Session extends Model {
    protected $table = "session";
    protected $primaryKey = "id";

    protected $fillable = [
        'session_id',
        'expire_date',
        'user_id'
    ];
}