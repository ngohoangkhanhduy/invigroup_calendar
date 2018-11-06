# invigroup_calendar
Requirement:
--------------------------
Write PHP function, which returns day of standard seven days week of the imaginary calendar, assuming we know how often a leap year occurs, how many months it has and how many days it has in each month. Use the function to find the day of date 17.11.2013.
Definition of the calendar:
- each year has 13 months
- each even month has 21 days, each odd month has 22 days
- in leap year last month has less one day
- leap year is each year dividable by five without rest
- every week has 7 days: Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday - the first day of the year 1990 was Monday

Resolve:
--------------------------

There is two option: 
- Write function as a module of Drupal 8.x
- Write a function as  a PHP single file

Demo:
--------------------------
With module of Drupal 8: 
http://test.invigroup.com/invigroup/getday
With php single file:
http://invigroup.net/calendar.php
