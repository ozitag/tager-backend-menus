<?php

namespace OZiTAG\Tager\Backend\Menus\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class TagerMenuItem extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $table = 'tager_menu_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'label',
        'link',
        'is_new_tab',
    ];

    protected function getScopeAttributes()
    {
        return ['menu_id'];
    }
}
