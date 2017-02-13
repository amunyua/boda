/**
 * Created by eric on 1/29/17.
 */
var DashboardGraphs = {
    months: [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ],
    curr_date: function () {
        var d = new Date();
        return {
            curr_month: d.getMonth(),
            curr_year: d.getYear()
        };
    },
    loadMonths: function (selector) {
        var li = '';
        for (var i = 0; i <= 11; i++){
            li += '<li><a href="javascript:void(0);" month="'+ i +'">' + this.months[i] + '</a></li>';
        }
        $(selector).html(li);
    },
    setCurrentMonth: function (selector, curr_month) {
        var curr =  '<i class="fa fa-calendar"></i> '+ this.months[curr_month] +' <span class="caret">';
        if(selector == '')
            $('a.month').html(curr);
         else
            selector.html(curr);
    }
};

// defaults
DashboardGraphs.setCurrentMonth('', DashboardGraphs.curr_date().curr_month);
DashboardGraphs.loadMonths('ul.months');

// on selection of a month filter
$('ul.months > li > a').on('click', function () {
    var month = $(this).attr('month');
    var selector = $(this).parent().parent().parent().find('a.month');

    DashboardGraphs.setCurrentMonth(selector, month);
});

$('a[href="#s2"]').on('click', function () {

});

$.ajax({
    url: '/weekly-cash-collection',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        
    }
});