<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class investor_startup extends Model
{

    
    protected $table = 'investor_startups';
    protected $primaryKey = 'investors_id';
    public $incrementing = true; 
    protected $keyType = 'int';


    protected $fillable = [
        'user_id','inv_name','company','inv_location','inv_industry', 'year', 'inv_teamsize',
        'funding_ned', 'pitch_summ','inv_image'
    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
