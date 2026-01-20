<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class startup extends Model
{

    
    protected $table = 'startups';
    protected $primaryKey = 'startup_id';
    public $incrementing = true; 
    protected $keyType = 'int';


    protected $fillable = [
        'user_id', 'startup_name','company_name','location','industry_name','founded_year', 'team_size',
        'funding_need', 'pitch_summary','image'
    ];
    public function user()
    {
        return $this->belongsTo(user::class,'startup_id');
    }
}
