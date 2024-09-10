<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission; 

class Permission extends SpatiePermission
{
    use CrudTrait; 
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'permissions'; 
    protected $guarded = ['id']; 

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    
 
    public function customFunction()
    {
 
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

  
    public function scopeAdminPermissions($query)
    {
        return $query->where('name', 'LIKE', 'admin%');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    
    public function getNameAttribute($value)
    {
        return 'Permission: ' . $value;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
