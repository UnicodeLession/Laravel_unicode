<?php

namespace Modules\Category\src\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    // đệ quy ảo ma: https://chat.openai.com/share/9a4eb6f5-295e-40bc-b7d4-3b7098aee8b7
    function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }
    function subCategories(){
        return $this->children()->with('subCategories');
    }
}
