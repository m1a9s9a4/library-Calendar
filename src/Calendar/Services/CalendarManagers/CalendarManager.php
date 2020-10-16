<?php

namespace Mkato\Library\Calendar\Services\CalendarManagers;

interface CalendarManager
{
    public function set($i);
    public function getScheduleList();
    public function getBusyTime();
    public function getFreeTime();
}
