<?php

namespace OZiTAG\Tager\Backend\Menus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagerMenuItem extends Model
{
    public $timestamps = false;

    protected $table = 'tager_menu_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'label',
        'url',
        'open_new_tab',
        'priority',
    ];
}
