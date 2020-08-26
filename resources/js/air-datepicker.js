import datepicker from "air-datepicker/dist/js/datepicker.min.js";

$(document).ready(function(){

     if ($('html').attr('lang')=='en') {

        $.fn.datepicker.language['en'] =  {
            days: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ,'Saturday'],
            daysShort: [ 'Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
            daysMin: [ 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            months: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
            monthsShort: [ 'Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.' ],
            today: 'Today',
            clear: 'Clear',
            dateFormat: 'dd.mm.yyyy',
            timeFormat: 'hh:ii',
            firstDay: 7
        };

        $('.datepicker-before-js').datepicker({
            language: 'en',
            maxDate: new Date()
        });

        $('.datepicker-after-js').datepicker({
            language: 'en',
            minDate: new Date()
        });

    } else if ($('html').attr('lang')=='uk'){
        $.fn.datepicker.language['uk'] =  {
            days: [ 'Неділя', 'понеділок', 'вівторок', 'середа', 'четвер', 'п\'ятницю' ,' суботу '],
            daysShort: [ 'Вос', 'Пон', 'Вів', 'Сре', 'Чет', 'П\'ят', 'Суб'],
            daysMin: [ 'Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            months: [ 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень' ],
            monthsShort: [ 'січень', 'лютий', 'березнь', 'квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень', 'жовтень', 'листопад', 'грудень' ],
            today: 'Сегодня',
            clear: 'Очистить',
            dateFormat: 'dd.mm.yyyy',
            timeFormat: 'hh:ii',
            firstDay: 1
        };

        $('.datepicker-before-js').datepicker({
            language: 'uk',
            maxDate: new Date()
        });

        $('.datepicker-after-js').datepicker({
            language: 'uk',
            minDate: new Date()
        });
        
    } else {
        $('.datepicker-before-js').datepicker({
            maxDate: new Date()
        });

        $('.datepicker-after-js').datepicker({
            minDate: new Date()
        });
    }

});
