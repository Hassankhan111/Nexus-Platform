<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class profile extends Model
{

    protected $table = 'profiles';
    protected $primaryKey = 'profile_id';
    public $incrementing = true; 
    protected $keyType = 'int';
    protected $fillable = [
        'user_id',
        'bio',
        'startup_history',
        'investment_history',
        'preferences',
        'image',
        'location',
    ];

    public function user(){
     return $this->belongsTo(User::class,'profile_id');
    }
}
