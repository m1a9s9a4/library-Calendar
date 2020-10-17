<?php


namespace Mkato\Library\Calendar;

use Mkato\Library\Calendar\Services\CalendarManagers\CalendarManager;

class Calendar
{
    protected $manager;

    public function __construct(CalendarManager $manager)
    {
        $this->manager = $manager;
    }

    public function setClient($client)
    {
        $this->manager->set($client);
    }

    public function getBusyTimes($ids, $from, $to)
    {
        return $this->manager->busyTime($ids, $from, $to);
    }

    public function getFreeTimes($ids, $from, $to)
    {
        return $this->manager->freeTime($ids, $from, $to);
    }
}
