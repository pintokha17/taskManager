<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * mixin \Eloquent
 * @property int start
 * @property int pause
 * @property int is_active
 * @property int task_id
 * @property int user_id
 */
class TaskTime extends Model
{
    protected $table = 'task_time';

    public function task()
    {
        return $this->belongsTo('App\TaskTime');
    }

    public static function boot()
    {
        parent::boot();

        self::updating(function($model){
            $model->execution_time = $model->pause - $model->start;
        });
    }

    /**
     * @param $id
     * @return TaskTime|null
     */
    public static function getActiveTaskTime($id)
    {
        return self::where(['task_id' => $id, 'is_active' => '1'])->first();
    }

    public function run($id)
    {
        $task = new TaskTime();
        $task->start = date('U');
        $task->pause = 0;
        $task->is_active = 1;
        $task->task_id = $id;
        $task->save();
    }

    public function stop()
    {
        $this->pause = date('U');
        $this->is_active = 0;
        $this->save();
    }
}
