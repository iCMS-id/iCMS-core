<div class="dashboard_graph">
	<div class="row x_title">
		<div class="col-md-6">
			<h3>Network Activities <small>Graph title sub-title</small></h3>
		</div>
		<div class="col-md-6">
			<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
				<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
			</div>
		</div>
	</div>

	<div class="col-md-9 col-sm-9 col-xs-12">
		<div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
		<div style="width: 100%;">
			<div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
		</div>
	</div>

	<div class="col-md-3 col-sm-3 col-xs-12 bg-white">
		<div class="x_title">
			<h2>Top Campaign Performance</h2>
			<div class="clearfix"></div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-6">
			<div>
				<p>Facebook Campaign</p>
				<div class="">
					<div class="progress progress_sm" style="width: 76%;">
						<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
</div>

<script type="text/javascript" src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-progressbar-3.3.4.min.css') }}">

<script type="text/javascript" src="{{ asset('js/jquery.flot.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flot.time.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flot.stack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flot.resize.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/plugins/jquery.flot.orderBars.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/date.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/jquery.flot.spline.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/curvedLines.js') }}"></script>
<script type="text/javascript">
      $(document).ready(function() {
        var data1 = [
          [gd(2012, 1, 1), 17],
          [gd(2012, 1, 2), 74],
          [gd(2012, 1, 3), 6],
          [gd(2012, 1, 4), 39],
          [gd(2012, 1, 5), 20],
          [gd(2012, 1, 6), 85],
          [gd(2012, 1, 7), 7]
        ];

        var data2 = [
          [gd(2012, 1, 1), 82],
          [gd(2012, 1, 2), 23],
          [gd(2012, 1, 3), 66],
          [gd(2012, 1, 4), 9],
          [gd(2012, 1, 5), 119],
          [gd(2012, 1, 6), 6],
          [gd(2012, 1, 7), 9]
        ];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1, data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
</script>