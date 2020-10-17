<?php

namespace Mkato\Library\Calendar\Services\CalendarManagers;

use Carbon\Carbon;
use Mkato\Library\Calendar\Services;

class GoogleCalendarManager implements CalendarManager
{
    protected $client;

    /** @var \Google_Service_Calendar */
    protected $calendar;

    public function set($client)
    {
        $this->client = $client;
    }

    public function busyTime($ids, $start, $end)
    {
        try {
            $this->calendar = $this->getCalendar();
            $busy_calendar = new \Google_Service_Calendar_FreeBusyRequest();
            $busy_calendar->setTimeMin($this->formatDateTime($start));
            $busy_calendar->setTimeMax($this->formatDateTime($end));
            $busy_calendar->setTimeZone(config('app.timezone'));
            $busy_calendar->setItems($this->formatIds($ids));
            $schedules = $this->calendar->freebusy->query($busy_calendar)->getCalendars();
            $busy_times = $this->formatSchedule($schedules);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $busy_times;
    }

    public function freeTime($ids, $start, $end)
    {
        $busy_times = $this->busyTime($ids, $start, $end);
        $free_times = [];
        $keep_box = null;
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        try {
            foreach ($busy_times as $index => $busy_time) {
                if ($index === array_key_first($busy_times)) {
                    if (! $busy_time->getStart()->eq($start)) {
                        $free_times[] = new Services\Schedules\GoogleSchedule([$ids], $start, $busy_time->getStart());
                    }
                } else {
                    $free_times[] = new Services\Schedules\GoogleSchedule([$ids], $keep_box->getEnd(), $busy_time->getStart());
                }

                if ($index === array_key_last($busy_times)) {
                    if ($busy_time->getEnd()->eq($end)) {
                        break;
                    }

                    $free_times[] = new Services\Schedules\GoogleSchedule([$ids], $busy_time->getEnd(), $end);
                }
                $keep_box = $busy_time;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $free_times;
    }

    private function formatSchedule($schedules)
    {
        $formatted_schedule = [];
        foreach ($schedules as $id => $schedule) {
            $busy = object_get($schedule, 'busy');
            foreach ($busy as $time) {
                $formatted_schedule[] = new Services\Schedules\GoogleSchedule(
                    [$id],
                    data_get($time, 'start'),
                    data_get($time, 'end')
                );
            }
        }

        return $formatted_schedule;
    }

    private function getCalendar()
    {
        return new \Google_Service_Calendar($this->client);
    }

    /**
     * @param Carbon $datetime
     * @throws \Exception
     * @return string
     */
    private function formatDateTime($datetime): string
    {
        return Carbon::parse($datetime)->toAtomString();
    }

    /**
     * @param string|array $ids
     * @return array
     */
    private function formatIds($ids): array
    {
        $formatted_ids = [];
        if (is_string($ids)) {
            $ids = [$ids];
        }

        foreach ($ids as $id) {
            $formatted_ids[] = ['id' => $id];
        }

        return $formatted_ids;
    }
}
