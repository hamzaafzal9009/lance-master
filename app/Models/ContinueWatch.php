<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContinueWatch extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function video()
    {
        return $this->belongsTo('App\Models\VideoContent');
    }

    public function videoHistory()
    {
        return $this->belongsTo('App\Models\VideoContent','v_id','id');
    }

    public function userHistory()
    {
        return $this->belongsTo('App\Models\User', 'u_id','id');
    }

    public static function continueWatching($data){
        $model = ContinueWatch::where('u_id', $data['uid'])->where('v_id',$data['vid'])->get();

        if($model->count()){
            DB::table('continue_watches')
            ->where('u_id', $data['uid'])
            ->where('v_id',$data['vid'])
            ->update(['time'=>$data['time']]);
        }else{
            $res =  DB::table('continue_watches')->insert(
                ['u_id' => $data['uid'], 'v_id' => $data['vid'], 'time'=>$data['time']]
            );
        }

    }

    public static function continueWatchLoad($data){
        $model = ContinueWatch::where('u_id', $data['uid'])->where('v_id',$data['vid'])->first();
        if($model != null){
            $res = [
                'time'=>$model->time,
                'status'=>'success'
                ];
        }else{
            $res = [
                'time'=>0,
                'status'=>'failed'
                ];
        }
        return $res;
    }
}
