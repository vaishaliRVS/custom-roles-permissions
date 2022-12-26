<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table='role_user';
    protected $fillable = [
        'user_id','role_id'
    ];

    public static $role_attach_rules = [
        'roles' => 'required|array|min:1|exists:roles,id'
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function role(){
        return $this->hasOne('App\Models\Role', 'id', 'user_id');
    }
}
