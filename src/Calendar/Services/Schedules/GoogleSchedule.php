<?php
/**
 * Googleカレンダー用のスケジュール管理クラス
 */

namespace Mkato\Library\Calendar\Services\Schedules;

use Carbon\Carbon;

class GoogleSchedule implements ScheduleInterface
{
    protected $members;
    protected $start;
    protected $end;

    public function __construct($members, $start, $end)
    {
        $this->members = $members;
        $this->start = Carbon::parse($start);
        $this->end = Carbon::parse($end);
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
}
