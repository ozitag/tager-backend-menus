<?php

namespace OZiTAG\Tager\Backend\Menus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagerMenu extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;

    protected $table = 'tager_menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alias',
        'label'
    ];
}