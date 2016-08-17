<?php 

return [
	['name' => '<i class="fa fa-home"></i> Dashboard', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.home']],
	['name' => '<i class="fa fa-newspaper-o"></i> Posts', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.post']],
	['name' => '<i class="fa fa-file"></i> Page', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.page']],
	['name' => '<i class="fa fa-calendar"></i> Events', 'children' => [
		['name' => 'Events', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.event']],
		['name' => 'Upcoming Events', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.event.upcomming']],
	]],
	['name' => '<i class="fa fa-youtube-play"></i> Media', 'children' => [
		['name' => 'Document', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.media']],
		['name' => 'Image', 'options' => ['type' => 'url', 'target' => 'self', 'url' => '#']],
		['name' => 'Music', 'options' => ['type' => 'url', 'target' => 'self', 'url' => '#']],
		['name' => 'Video', 'options' => ['type' => 'url', 'target' => 'self', 'url' => '#']],
	]],
	['name' => '<i class="fa fa-bell-o"></i> Notification', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.notify']],
	['name' => '<i class="fa fa-cogs"></i> Settings', 'children' => [
		['name' => 'Application', 'options' => ['type' => 'url', 'target' => 'self', 'url' => '#']],
		['name' => 'Packages', 'options' => ['type' => 'url', 'target' => 'self', 'url' => '#']],
		['name' => 'Users', 'options' => ['type' => 'url', 'target' => 'self', 'route' => 'admin.users']],
	]],
];