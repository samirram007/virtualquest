<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenApplication extends Model
{
    use HasFactory;
    protected $connection = 'mysql_token';
    protected $table = 'token_applications';

}
