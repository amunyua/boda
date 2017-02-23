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
            curr_year: d.getFullYear()
        };
    },
    loadMonths: function (selector) {
        var li = '';
        for (var i = 0; i <= 11; i++){
            li += '<li><a href="javascript:void(0);" month="'+ i +'">' + this.months[i] + '</a></li>';
        }
        $(selector).html(li);
    },
    loadYears: function(selector){
        var d = new Date();
        var li = '';
        for (var i = 2010; i <= 2017; i++){
            li += '<li><a href="javascript:void(0);" year="'+ i +'">' + i + '</a></li>';
        }
        $(selector).html(li);
    },
    setCurrentMonth: function (selector, curr_month) {
        var curr =  '<i class="fa fa-calendar"></i> '+ this.months[curr_month] +' <span class="caret"></span>';
        if(selector == '')
            $('a.month').html(curr);
         else
            $(selector).html(curr);
    },
    setCurrentYear: function (selector, curr_year) {
        var curr =  '<i class="fa fa-calendar"></i> '+ curr_year +' <span class="caret"></span>';
        if(selector == '')
            $('a.year').html(curr);
        else
            $(selector).html(curr);
    },
    filterByMonth: function(month){
        $.ajax({
            url: 'daily-cash-collection?month_yr=' + month_yr,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var count = data.collections.length,
                    data1 = [];
                for (var i = 0; i < count; i++) {
                    data1.push([data.collections[i][0], data.collections[i][1]]);
                }

                var ds = new Array();

                ds.push({
                    data: data1,
                    bars: {
                        show: true,
                        barWidth: 0.2,
                        order: 1,
                    }
                });

                //Display graph
                DashboardGraphs.dailyGraph(ds);
            }
        });
    },
    dailyGraph: function(ds){
        $.plot($("#daily-chart"), ds, {
            colors: [$chrt_second, $chrt_fourth, "#666", "#BBB"],
            grid: {
                show: true,
                hoverable: true,
                clickable: true,
                tickColor: $chrt_border_color,
                borderWidth: 0,
                borderColor: $chrt_border_color,
            },
            legend: true,
            tooltip: true,
            tooltipOpts: {
                content: "<b>%x</b> = <span>%y</span>",
                defaultTheme: false
            }
        });
    }
};

// defaults
DashboardGraphs.setCurrentMonth('a.month', DashboardGraphs.curr_date().curr_month);
DashboardGraphs.setCurrentYear('a.year', DashboardGraphs.curr_date().curr_year);
DashboardGraphs.loadMonths('ul.months');
DashboardGraphs.loadYears('ul.select-years');

// initialize datepicker
$(function () {
    $(document).find('.datepicker79').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM'
    });
});

// filtering


// on selection of a month filter
$('ul.months > li > a').on('click', function () {
    var month = $(this).attr('month');
    var selector = $(this).parent().parent().parent().find('a.month');

    DashboardGraphs.setCurrentMonth(selector, month);
});