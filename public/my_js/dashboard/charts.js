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

                DashboardGraphs.weeklyGraph(cash_collection);
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

                DashboardGraphs.monthlyGraph(cash_collection);
            }
        });
    }

    /* end monthly chart */
});

/* end flot charts */