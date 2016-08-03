<?php 

return [
	'<i class="fa fa-home"></i> Dashboard' => resolveRoute('admin.home'),
	'<i class="fa fa-newspaper-o"></i> Posts' => '#',
	'<i class="fa fa-file"></i> Page' => '#',
	'<i class="fa fa-calendar"></i> Events' => [
		'Events' => '#',
		'Upcoming Events' => '#',
	],
	'<i class="fa fa-youtube-play"></i> Media' => [
		'Document' => '#',
		'Image' => '#',
		'Music' => '#',
		'Video' => '#',
	],
	'<i class="fa fa-bell-o"></i> Notification' => '#',
	'<i class="fa fa-cogs"></i> Settings' => [
		'Application' => '#',
		'Packages' => '#',
		'Users' => resolveRoute('admin.users'),
	],
];