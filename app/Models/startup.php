<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class startup extends Model
{

    
    protected $table = 'startups';
    protected $primaryKey = 'startup_id';
    public $incrementing = true; 
    protected $keyType = 'int';


    protected $fillable = [
        'user_id', 'founded_year', 'team_size',
        'funding_need', 'pitch_summary'
    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
