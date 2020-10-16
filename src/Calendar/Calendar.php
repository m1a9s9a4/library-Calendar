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

    public function setInstance($instance)
    {
        $this->manager->set($instance);
    }
}
