<?php

namespace Mkato\Library\Calendar\Services\CalendarManagers;

interface CalendarManager
{
    /**
     * set client to connect via api
     * @var $client
     * @var $id
     */
    public function set($client);
    public function busyTime($ids, $start, $end);
    public function freeTime($ids, $start, $end);
}
