<div class="x_panel">
	<div class="x_title">
		<h2>Visitors location <small>geo-presentation</small></h2>
		<ul class="nav navbar-right panel_toolbox">
			<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Settings 1</a></li>
					<li><a href="#">Settings 2</a></li>
				</ul>
			</li>
			<li><a class="close-link"><i class="fa fa-close"></i></a></li>
		</ul>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<div class="dashboard-widget-content">
			<div class="col-md-4 hidden-small">
				<h2 class="line_30">125.7k Views from 60 countries</h2>

				<table class="countries_list">
					<tbody>
						<tr>
							<td>United States</td>
							<td class="fs15 fw700 text-right">33%</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-jvectormap-2.0.3.css') }}">
<script src="{{ asset('js/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('js/jquery-jvectormap-us-aea-en.js') }}"></script>
<script src="{{ asset('js/gdp-data.js') }}"></script>
<script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
          map: 'world_mill_en',
          backgroundColor: 'transparent',
          zoomOnScroll: false,
          series: {
            regions: [{
              values: gdpData,
              scale: ['#E6F2F0', '#149B7E'],
              normalizeFunction: 'polynomial'
            }]
          },
          onRegionTipShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
</script>