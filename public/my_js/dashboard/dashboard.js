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
        var option = '';

        for (var i = 0; i <= 11; i++){
            var selected = '';
            if(i == this.curr_date().curr_month)
                var selected = 'selected';

            option += '<option value="' + i + '" '+ selected +'>' + this.months[i] + '</option>';
        }
        $(selector).html(option);
    },
    loadYears: function(selector){
        var d = new Date();
        var option = '';

        for (var i = 2010; i <= 2017; i++){
            var selected = '';
            if(i == this.curr_date().curr_year)
                var selected = 'selected';

            option += '<option value="'+ i +'" ' + selected + '>' + i + '</option>';
        }
        $(selector).html(option);
    },
    filterByMonth: function(month_yr){
        $.ajax({
            url: 'daily-cash-collection?month=' + month_yr['month'] + '&year=' + month_yr['year'],
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
    },
    filterWeeklyGraph: function (month_yr) {
        $.ajax({
            url: 'weekly-cash-collection?month=' + month_yr['month'] + '&year=' + month_yr['year'],
            type: 'GET',
            dataType: 'json',
            success: function(data){
                var count = data.collections.length;
                for(var i = 0; i < count; i++){
                    cash_collection.push([data.collections[i][0], data.collections[i][1]]);
                }

                DashboardGraphs.weeklyGraph(cash_collection, count);
            }
        });
    },
    weeklyGraph: function (cash_collection, count) {
        var plot = $.plot($("#weekly-chart"), [{
            data : cash_collection,
            label : "Amount Collected"
        }], {
            series : {
                lines : {
                    show : true
                },
                points : {
                    show : true
                }
            },
            grid : {
                hoverable : true,
                clickable : true,
                tickColor : $chrt_border_color,
                borderWidth : 0,
                borderColor : $chrt_border_color,
            },
            tooltip : true,
            tooltipOpts : {
                content : "Week <b>%x</b> Amount Collected <span>%y</span>",
                defaultTheme : false
            },
            colors : [$chrt_second, $chrt_fourth],
            yaxis : {
                min : 0,
//                    max : 1.1
            },
            xaxis : {
                min : 1,
                max : count,
                minTickSize: 1
            }
        });

        $("#weekly-chart").bind("plotclick", function(event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    },
    filterMonthlyGraph: function (year) {
        $.ajax({
            url: 'monthly-cash-collection?year=' + year,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                var count = data.collections.length;
                for(var i = 0; i < count; i++){
                    cash_collection.push([data.collections[i][0], data.collections[i][1]]);
                }

                DashboardGraphs.monthlyGraph(cash_collection);
            }
        });
    },
    monthlyGraph: function (cash_collection, count) {
        var plot = $.plot($("#monthly-chart"), [{
            data : cash_collection,
            label : "Amount Collected"
        }], {
            series : {
                lines : {
                    show : true
                },
                points : {
                    show : true
                }
            },
            grid : {
                hoverable : true,
                clickable : true,
                tickColor : $chrt_border_color,
                borderWidth : 0,
                borderColor : $chrt_border_color,
            },
            tooltip : true,
            tooltipOpts : {
                content : "Month <b>%x</b> Amount Collected <span>%y</span>",
                defaultTheme : false
            },
            colors : [$chrt_second, $chrt_fourth],
            yaxis : {
                min : 0,
//                    max : 1.1
            },
            xaxis : {
                min : 1,
                max : count,
                minTickSize: 1
            }
        });

        $("#monthly-chart").bind("plotclick", function(event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });
    }
};

// defaults
DashboardGraphs.loadMonths('select.months');
DashboardGraphs.loadYears('select.select-years');

// filter daily chart
$('select.daily-months').on('change', function(){
    var selected_month = $(this).val();
    var selected_yr = $('select.daily-select-years').val();
    var month_yr = [];

    month_yr['month'] = selected_month;
    month_yr['year'] = selected_yr;

    DashboardGraphs.filterByMonth(month_yr);
});

$('select.daily-select-years').on('change', function(){
    var selected_yr = $(this).val();
    var selected_month = $('select.daily-months').val();
    var month_yr = [];

    month_yr['month'] = selected_month;
    month_yr['year'] = selected_yr;

    DashboardGraphs.filterByMonth(month_yr);
});

// filter monthly chart
$('select.monthly-months').on('change', function(){
    var selected_month = $(this).val();
    var selected_yr = $('select.monthly-select-years').val();
    var month_yr = [];

    month_yr['month'] = selected_month;
    month_yr['year'] = selected_yr;

    DashboardGraphs.filterWeeklyGraph(month_yr);
});

$('select.monthly-select-years').on('change', function(){
    var selected_yr = $(this).val();
    var selected_month = $('select.daily-months').val();
    var month_yr = [];

    month_yr['month'] = selected_month;
    month_yr['year'] = selected_yr;

    DashboardGraphs.filterWeeklyGraph(month_yr);
});

// filter yearly chart
$('select.yearly-select-years').on('change', function(){
    var selected_yr = $(this).val();
    DashboardGraphs.filterMonthlyGraph(selected_yr);
});

// on selection of a month filter
$('ul.months > li > a').on('click', function () {
    var month = $(this).attr('month');
    var selector = $(this).parent().parent().parent().find('a.month');

    DashboardGraphs.setCurrentMonth(selector, month);
});