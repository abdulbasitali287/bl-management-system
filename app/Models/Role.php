<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['rid'];
    protected $primaryKey = 'rid';

    protected $fillable = ['name','guard_name','user_id','status'];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
