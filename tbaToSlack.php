<?php
//include 'php/const.php';
//echo $_POST['verification'];
    
//$json = file_get_contents('php://input');
//file_put_contents("raw.json", file_get_contents('php://input'));
file_put_contents("tbaToSlack.txt", file_get_contents('php://input'));

//$action = json_decode($json, true);
//file_put_contents("tbaToSlack.txt", $json);
//echo var_dump(json_decode(file_get_contents("tbaToSlack.txt")));

//echo var_dump(json_decode(file_get_contents("tbaToSlack.txt"))->message_data->match->alliances);

/*$matchData = json_decode(file_get_contents('php://input'));

if ($matchData != null) {
	if ($matchData->message_type != "verification") {
		
		require '/var/www/html/tba-to-slack-php/vendor/autoload.php';
		$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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');

		$settings = [
			'username' => 'Announcer McAnnouncerpants',
			'channel' => '#testing',
			'icon' => ':netscape:',
			'link_names' => true
		];

		if ($matchData->message_type == "upcoming_match") {
			$teams['all'] = $matchData->message_data->team_keys;
		}
		else if ($matchData->message_type == "match_score") {
			$teams['all'] = array_merge($matchData->message_data->match->alliances->blue->teams, $matchData->message_data->match->alliances->red->teams);
		}

		// in_array("frc118", $teams['all'])

		if (in_array("frc1306", $teams['all']) && $matchData != json_decode(file_get_contents("tbaToSlack.txt"))) {
			$teams['red'] = str_replace('frc','',$matchData->message_data->team_keys[0] . ', ' . $matchData->message_data->team_keys[1] . ', ' . $matchData->message_data->team_keys[2]);
			$teams['blue'] = str_replace('frc','',$matchData->message_data->team_keys[3] . ', ' . $matchData->message_data->team_keys[4] . ', ' . $matchData->message_data->team_keys[5]);
			$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);
			if ($matchData->message_type == 'upcoming_match') {
				$title = "Upcoming Match";
				$payload['title'] = $matchData->message_data->event_name;
				$payload['text'] = "";
				$payload['color'] = "warning";
				$payload['redTitle'] = "Red Alliance:";
				$payload['blueTitle'] = "Blue Alliance:";
			}
			else if ($matchData->message_type == 'match_score') {
				$title = 'Match Score';
				$payload['title'] = $matchData->message_data->event_name;
				$payload['text'] = matchDecode($matchData->message_data->match->comp_level) . ": " . $matchData->message_data->match->match_number . "-" . $matchData->message_data->match->match_number;
				$payloac['color'] = "success";
				$payload['redTitle'] = "Red Alliance - " . $matchData->message_data->match->alliances->red->score . " pts";
				$payload['blueTitle'] = "Blue Alliance - " . $matchData->message_data->match->alliances->blue->score . " pts";
				$teams['red'] = str_replace('frc','',$matchData->message_data->match->alliances->red->teams[0] . ', ' . $matchData->message_data->match->alliances->red->teams[1] . ', ' . $matchData->message_data->match->alliances->red->teams[2]);
				$teams['blue'] = str_replace('frc','',$matchData->message_data->match->alliances->blue->teams[0] . ', ' . $matchData->message_data->match->alliances->blue->teams[1] . ', ' . $matchData->message_data->match->alliances->blue->teams[2]);
			}
				$client->attach([
					'title' => $payload['title'],
					'title_link' => '',
					'fallback' => $payload['title'],
					'text' => $payload['text'],
					'color' => $payload['color'],
					'fields' => [
						[
							'title' => $payload['redTitle'],
							'value' => $teams['red'],
							'short' => true // whether the field is short enough to sit side-by-side other fields, defaults to false
						],
						[
							'title' => $payload['blueTitle'],
							'value' => $teams['blue'],
							'short' => true
						]
					]
				])->send($title);
		}
	}
}

file_put_contents("tbaToSlack.txt",json_encode($matchData));

function matchDecode($match) {
    switch ($match) {
        case 'f':
            return "Final";
        break;
        case 'sf':
            return "Semifinal";
        break;
        case 'qf':
            return "Quarterfinal";
        break;
        case 'qm':
            return "Qualification";
        break;
        default:
            return null;
        break;
    }
}*/
?>
