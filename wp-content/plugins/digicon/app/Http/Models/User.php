<?php
namespace Digicon\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';
    /**
     * @var array
     */
    protected $fillable = ['user_login', 'user_nicename', 'user_email', 'display_name'];
}
