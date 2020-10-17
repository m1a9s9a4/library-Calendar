<?php

namespace Mkato\Library\Calendar\Services\Schedules;

interface ScheduleInterface
{
    public function getMembers();
    public function getStart();
    public function getEnd();
}
