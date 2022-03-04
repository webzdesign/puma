<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded =  [];

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function UpdatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'categories_roles');
    }
}
