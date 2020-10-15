<?php

namespace Mkato\Library\Calendar\Services\CalendarManagers;

interface CalendarManagerInterface
{
    public function getScheduleList();
    public function getBusyTime();
    public function getFreeTime();
}
