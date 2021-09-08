<?php

namespace Modules\HR\Entities;

use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Maxslot extends Model
{   
    //use SoftDeletes;
    protected $table = 'maxslots';
    protected $fillable = ['max_interviews_per_day',];
    //protected $hidden = ['created_at', 'updated_at',];

    public function user()
    {   
        return  $this->belongsTo (User::class);
    }

     public static function getUserData()
    {   
        $userId=Auth::User('id');
        $maxslots=DB::table('maxslots')->select('max_interviews_per_day')->where('user_id', $userId)->orderByDesc('created_at')->first();
        
        return $maxslots;

    }
}