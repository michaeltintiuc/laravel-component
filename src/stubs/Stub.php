<?php
namespace App\Components\Stubs;

use Illuminate\Database\Eloquent\Model;

class Stub extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stubs';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['*'];
}
