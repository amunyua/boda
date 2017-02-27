// PAGE RELATED SCRIPTS

/* chart colors default */
var $chrt_border_color = "#efefef";
var $chrt_grid_color = "#DDD"
var $chrt_main = "#E24913";
/* red       */
var $chrt_second = "#6595b4";
/* blue      */
var $chrt_third = "#FF9F01";
/* orange    */
var $chrt_fourth = "#7e9d3a";
/* green     */
var $chrt_fifth = "#BD362F";
/* dark red  */
var $chrt_mono = "#000";

$(document).ready(function() {

    // DO NOT REMOVE : GLOBAL FUNCTIONS!
    pageSetUp();

    /* daily bar chart */

    if ($("#daily-chart").length) {

        $.ajax({
            url: 'daily-cash-collection',
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

    }

    /* end daily bar chart */

    /* Weekly chart */

    if ($("#weekly-chart").length) {
        var cash_collection = [];

        $.ajax({
            url: 'weekly-cash-collection',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                var count = data.collections.length;
                for(var i = 0; i < count; i++){
                    cash_collection.push([data.collections[i][0], data.collections[i][1]]);
                }

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
            }
        });
    }

    /* end weekly chart */

    /* Monthly chart */

    if ($("#monthly-chart").length) {
        var cash_collection = [];

        $.ajax({
            url: 'monthly-cash-collection',
            type: 'GET',
            dataType: 'json',
            success: function(data){
                var count = data.collections.length;
                for(var i = 0; i < count; i++){
                    cash_collection.push([data.collections[i][0], data.collections[i][1]]);
                }

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
        });
    }

    /* end monthly chart */
});

/* end flot charts */