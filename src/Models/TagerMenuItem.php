<?php

namespace OZiTAG\Tager\Backend\Menus\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class TagerMenuItem
 * @package OZiTAG\Tager\Backend\Menus\Models
 *
 * @property integer $id
 * @property string $menu_alias
 * @property string $label
 * @property string $link
 * @property bool $is_new_tab
 */
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
        'menu_alias',
        'label',
        'link',
        'is_new_tab',
    ];

    protected function getScopeAttributes()
    {
        return ['menu_alias'];
    }
}
