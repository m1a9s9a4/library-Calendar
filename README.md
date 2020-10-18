# library-calendar
https://packagist.org/packages/mkato/library-calendar

```
composer require mkato/library-calendar 
```
## about
Calender Manager (ex: GoogleCalenderManager) is doing the hard things.
It get's the schedules from the calendar via api.

If you're using google calendar, the code is ready for you.
Use Calendar.php and it's already connected with the GoogleCalendarManager.

To use a different calendar, you have to create a calendar manager and schedule using the interface of those two.
Then use service provider to extend the singleton of CalendarManager::class to your created class.   

## how to use?
Calling the Calendar.php, you can get your busy time or free time.
However, you have to authenticate your email so it can access your calendar.

## features

### free time
It returns the time which has no schedule between the datetime you passed.
Because it just looks into the schedule, the target time is 24 hours. Therefore midnight time will also be selected as a free time.

### busy time
It returns the time which has some kind of schedule.

