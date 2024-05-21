<?php
include_once "error_handling.php";
ini_set('date.timezone', 'Europe/Berlin');
$date = new DateTime('now');
$locale = 'de_DE';

$thisWeek = IntlCalendar::fromDateTime($date, $locale);
$thisWeek->set(IntlCalendar::FIELD_DAY_OF_WEEK, $thisWeek->getFirstDayOfWeek());
// $thisWeek now points to the first day of the week
$weekStart = $thisWeek->toDateTime();

$daysToAdvance = $thisWeek->getMaximum(IntlCalendar::FIELD_DAY_OF_WEEK) - 1;
// Maximum number of days in a week minus 1 gets you to the last day
$weekEnd = $weekStart->modify("+{$daysToAdvance} days");

$previousWeek = IntlCalendar::fromDateTime($date, $locale);
$previousWeek->add(IntlCalendar::FIELD_WEEK_OF_YEAR, -1);
$previousWeek = $previousWeek->toDateTime();

$nextWeek = IntlCalendar::fromDateTime($date, $locale);
$nextWeek->add(IntlCalendar::FIELD_WEEK_OF_YEAR, 1);
$nextWeek = $nextWeek->toDateTime();

echo "<pre>";
print_r($thisWeek);
?>