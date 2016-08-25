<div id="heading-breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>@yield('title','Welcome to iCMS')</h1>
			</div>
			<div class="col-md-6">
				<ul class="breadcrumb">
					<li><a href="{{ resolveRoute('app.home') }}">Home</a></li>
					<li>@yield('title','Welcome to iCMS')</li>
				</ul>

			</div>
		</div>
	</div>
</div>