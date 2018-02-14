<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Khill\Duration\Duration;
use Auth;

/**
 * App\Task
 *
 * @mixin \Eloquent
 * @property string id
 * @property string name
 * @property string description
 * @property string status
 * @property integer start
 * @property integer pause
 * @property integer is_active
 * @property integer user_id
 */
class Task extends Model
{
    protected $table = 'tasks';

    const STATUS_STARTED = 'started';
    const STATUS_PAUSE = 'pause';
    const STATUS_COMPLETED = 'completed';

    public function time()
    {
        return $this->hasMany('App\TaskTime');
    }

    public function start()
    {
        if ($this->status === self::STATUS_STARTED) {
            return;
        }

        $this->status = self::STATUS_STARTED;

        $task = Task::where(['user_id' => Auth::id(), 'status' => self::STATUS_STARTED])->first();
        // If we already have active task then switch it to paused
        if ($task) {
            $task->status = self::STATUS_PAUSE;
            $task->save();
        }

        $taskTime = TaskTime::getActiveTaskTime($this->id);

        if ($taskTime !== null) {
            $taskTime->stop();
        }

        // Start to calculate spent time
        (new TaskTime())->run($this->id);
        $this->save();
    }

    public function pause()
    {
        if ($this->status === self::STATUS_PAUSE) {
            return;
        }

        $this->status = self::STATUS_PAUSE;

        $taskTime = TaskTime::getActiveTaskTime($this->id);

        if ($taskTime !== null) {
            $taskTime->stop();
        }

        $this->save();
    }

    public function complete()
    {
        if ($this->status === self::STATUS_COMPLETED) {
            return;
        }

        $this->status = self::STATUS_COMPLETED;

        $taskTime = TaskTime::getActiveTaskTime($this->id);

        if ($taskTime !== null) {
            $taskTime->stop();
        }

        $this->save();
    }

    public static function getDuration($time, $task_id = null)
    {
        if ($task_id === null) {
            return (new Duration($time))->humanize();
        }

        $task = TaskTime::where(['task_id' => $task_id, 'is_active' => '1'])->first();

        if ($task === null) {
            return (new Duration($time))->humanize();
        }

        // If we have an active task - calculate how much time did we spent
        $start = strtotime($task->start);
        $activeSpentTime = (time()-$start);
        $time += $activeSpentTime;

        return (new Duration($time))->humanize();
    }

    public static function getTotalTime($tasks)
    {
        $totalTime = 0;

        foreach ($tasks as $task) {
            $totalTime += $task->total_time;
            if ($task->status === self::STATUS_STARTED) {
                $task = TaskTime::where(['task_id' => $task->id, 'is_active' => '1'])->first();

                if ($task === null) {
                    continue;
                }
                $start = strtotime($task->start);
                $totalTime += (time()-$start);
            }
        }

        return $totalTime;
    }

    public static function fieldIsEmpty($dateFrom, $dateTo)
    {
        if ($dateFrom === null | $dateTo === null)
            return redirect()->back()->with('error', 'One of the fields is not specified!');
    }

    public static function isCorrectInput($dateFrom, $dateTo)
    {
        if ($dateFrom > $dateTo)
            return redirect()->back()->with('error', 'incorrect input');
    }
}
