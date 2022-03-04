<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Traits\RoleHasRelations;

class Role extends Model
{
    use HasFactory;
    use RoleHasRelations;
    protected $guarded =  [];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'categories_roles');
    }

}
