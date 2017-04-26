<?php	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);	
	echo var_dump(function_exists('mb_substr'));
	require '/var/www/html/tba-to-slack-php/vendor/autoload.php';
	$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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');

	$settings = [
		'username' => 'Announcer McAnnouncerpants',
		'channel' => '#testing',
		'icon' => ':netscape:',
		'link_names' => true
	];
		$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
			$client->attach([
				'title' => "TITLE",
				'title_link' => '',
				'fallback' => "TITLE",
				'text' => "TITLE",
				'fields' => [
					[
						'title' => "TEST",
						'value' => "TEST2",
						'short' => true
					],
					[
						'title' => "TEST",
						'value' => "TEST2",
						'short' => true
					]
				]
			])->send("NULL");
?>
