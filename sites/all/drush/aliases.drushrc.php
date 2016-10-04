<?php

$aliases['dev'] = array(
	'uri'=> 'rebound.ccistaging.com',
	'root' => '/home/staging/subdomains/rebound/public_html',
	'remote-host'=> 'host.ccistudios.com',
	'remote-user'=> 'staging',
	'path-aliases'=> array(
		'%files'=> 'sites/default/files',
	),
	'ssh-options'=> '-p 37241'
);

$aliases['live'] = array(
	'uri'=> 'live.reboundonline.com',
	'root' => '/home/reboundsarnia/subdomains/live/public_html',
	'remote-host'=> 'reboundonline.com',
	'remote-user'=> 'reboundsarnia',
	'path-aliases'=> array(
		'%files'=> 'sites/default/files',
		'%drush-script' => '/home/reboundsarnia/bin/drush/drush'
	),
	'command-specific' => array(
		'rsync' => array(
			'rsync-path' => '/home/reboundsarnia/bin/rsync'
		)
	)
);
