$(document).ready(function() {
    $("#eventCalendarHumanDate").eventCalendar({
        eventsjson: 'http://localhost/project_sekolah/index/event_data_user',
        jsonDateFormat: 'human' // 'YYYY-MM-DD HH:MM:SS'
    });
});