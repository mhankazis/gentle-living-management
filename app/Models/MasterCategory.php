<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    protected $table = 'master_categories';
    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'name_category'
    ];
    
    // Relationship with items
    public function items()
    {
        return $this->hasMany(MasterItem::class, 'category_id', 'category_id');
    }
}
