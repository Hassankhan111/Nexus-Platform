<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\investor_startup;
use App\Models\startup;
class meeting extends Model
{
    protected $fillable = [
        'investor_id',
        'startup_id',
        'scheduled_at',
        'meeting_link',
    ];

    public function investor(){
        return $this->belongsTo(investor_startup::class, 'investor_id','investors_id');
    }

     public function startup(){
        return $this->belongsTo(startup::class,'startup_id');
    }
}
