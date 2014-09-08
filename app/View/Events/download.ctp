<?php
// Variables used in this script:
//   $summary     - text title of the event
//   $datestart   - the starting date (in seconds since unix epoch)
//   $dateend     - the ending date (in seconds since unix epoch)
//   $address     - the event's address
//   $uri         - the URL of the event (add http://)
//   $description - text description of the event
//   $filename    - the name of this file for saving (e.g. my-event-name.ics)
//
// Notes:
//  - the UID should be unique to the event, so in this case I'm just using
//    uniqid to create a uid, but you could do whatever you'd like.
//
//  - iCal requires a date format of "yyyymmddThhiissZ". The "T" and "Z"
//    characters are not placeholders, just plain ol' characters. The "T"
//    character acts as a delimeter between the date (yyyymmdd) and the time
//    (hhiiss), and the "Z" states that the date is in UTC time. Note that if
//    you don't want to use UTC time, you must prepend your date-time values
//    with a TZID property. See RFC 5545 section 3.3.5
//
//  - The Content-Disposition: attachment; header tells the browser to save/open
//    the file. The filename param sets the name of the file, so you could set
//    it as "my-event-name.ics" or something similar.
//
//  - Read up on RFC 5545, the iCalendar specification. There is a lot of helpful
//    info in there, such as formatting rules. There are also many more options
//    to set, including alarms, invitees, busy status, etc.
//
//      https://www.ietf.org/rfc/rfc5545.txt
 
// 1. Set the correct headers for this file
header('Content-type: text/calendar; charset=utf-8');
if(count($events) > 1){
header('Content-Disposition: attachment; filename=UMDEvent.ics'); 
} else {
    header('Content-Disposition: attachment; filename='.$events[0]['Event']['id'].'UMDEvent.ics');
}

 
// 2. Echo out the ics file's contents
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:College Park Events Calendar
CALSCALE:GREGORIAN
<?php foreach ($events as $event): ?>
    BEGIN:VEVENT
    UID:<?php echo $event['Event']['id']; ?>UMDEventSystem
    DTSTART:<?php echo date('Ymd\THis', strtotime($event['Event']['start'])) . "\r\n"; ?>
    DTEND:<?php echo date('Ymd\THis', strtotime($event['Event']['end'])) . "\r\n"; ?>
    LOCATION:<?php echo $event['Event']['location_details'] . "\r\n"; ?>
    SUMMARY:<?php echo $event['Event']['title'] . "\r\n"; ?>
    DESCRIPTION:<?php echo $event['Event']['description'] . "\r\n"; ?>
    ORGANIZER;CN=<?php echo $event['Event']['point_of_contact'];?>:MAILTO:<?php echo $event['Event']['point_of_contact'];?>@terpmail.umd.edu
    CATEGORIES:<?php echo $event['Event']['event_type'] . "\r\n";?>
    END:VEVENT
<?php endforeach; ?>
END:VCALENDAR