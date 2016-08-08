<?php 

return [
	'<i class="fa fa-home"></i> Dashboard' => resolveRoute('admin.home'),
	'<i class="fa fa-newspaper-o"></i> Posts' => resolveRoute('admin.post'),
	'<i class="fa fa-file"></i> Page' => resolveRoute('admin.page'),
	'<i class="fa fa-calendar"></i> Events' => [
		'Events' => resolveRoute('admin.event'),
		'Upcoming Events' => resolveRoute('admin.event.upcomming'),
	],
	'<i class="fa fa-youtube-play"></i> Media' => [
		'Document' => resolveRoute('admin.media'),
		'Image' => '#',
		'Music' => '#',
		'Video' => '#',
	],
	'<i class="fa fa-bell-o"></i> Notification' => resolveRoute('admin.notify'),
	'<i class="fa fa-cogs"></i> Settings' => [
		'Application' => '#',
		'Packages' => '#',
		'Users' => resolveRoute('admin.users'),
	],
];