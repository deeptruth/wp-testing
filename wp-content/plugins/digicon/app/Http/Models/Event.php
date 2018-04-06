<?php
namespace Digicon\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * @var string
     */
    protected $table = 'events';
    /**
     * @var array
     */
    protected $fillable = ['title', 'code'];
}
