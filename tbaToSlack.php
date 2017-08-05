<?php
// Bot username
const SLACK_USERNAME       = 'Announcer McAnnouncerpants';
// Bot icon can be any emoji
const SLACK_ICON           = ':netscape:';
// Channel that the bot will post messages to
const SLACK_CHANNEL        = '#testing';
// Paste your Slack incoming webhook url here
const SLACK_HOOK           = 'https://hooks.slack.com/services/Txxxxxxxx/XXXXXXXXX/xxxxxxxxxxxxxxxxxxxxxxxx';
// Color for upcoming matches
const SLACK_UPCOMING_COLOR = 'warning';
// Color for match scores
const SLACK_SCORE_COLOR    = 'success';

// Turn on/off certain messages
const SEND_UPCOMING_MATCH  = true;
const SEND_MATCH_SCORE     = true;

const CHECK_SAME_FILE      = 'tbaToSlack.json';
const VERIFICATION_FILE    = 'verification.json';

// Get the raw input (JSON)
$input = file_get_contents('php://input');

// Uncomment the line below for debugging
file_put_contents("raw.json", $input);

// Decode the JSON input
$matchData = json_decode($input);

if ($matchData != null) {
	if ($matchData->message_type == "verification") {
		// This means we are in verification step, put everything in the verification.json file
		file_put_contents(VERIFICATION_FILE, $input);
	} else {
		
		require '/var/www/html/tba-to-slack-php/vendor/autoload.php';
		$client = new Maknz\Slack\Client(SLACK_HOOK);

		$settings = [
		'username' => SLACK_USERNAME,
		'channel' => SLACK_CHANNEL,
		'icon' => SLACK_ICON,
		'link_names' => true
		];

		if ($matchData->message_type == "upcoming_match" && SEND_UPCOMING_MATCH) {
			// Create array of all teams
			$teams['all'] = $matchData->message_data->team_keys;
			$incomingMatchType = 'upcoming';
		} else if ($matchData->message_type == "match_score" && SEND_MATCH_SCORE) {
			// Create array of all teams
			$teams['all'] = array_merge($matchData->message_data->match->alliances->blue->teams, $matchData->message_data->match->alliances->red->teams);
			$incomingMatchType = 'score';
		}
		// Make sure we haven't already sent this message
		if ($matchData != json_decode(file_get_contents(CHECK_SAME_FILE))) {
			$teams['red'] = str_replace('frc','',$matchData->message_data->team_keys[0] . ', ' . $matchData->message_data->team_keys[1] . ', ' . $matchData->message_data->team_keys[2]);
			$teams['blue'] = str_replace('frc','',$matchData->message_data->team_keys[3] . ', ' . $matchData->message_data->team_keys[4] . ', ' . $matchData->message_data->team_keys[5]);
			// Recreate client with settings
			$client = new Maknz\Slack\Client(SLACK_HOOK, $settings);
			$sendMsg = false;
			if ($matchData->message_type == 'upcoming_match' && SEND_UPCOMING_MATCH) {
				$title = "Upcoming Match";
				$payload['title'] = $matchData->message_data->event_name;
				$payload['text'] = "";
				$payload['color'] = SLACK_UPCOMING_COLOR;
				$payload['redTitle'] = "Red Alliance:";
				$payload['blueTitle'] = "Blue Alliance:";
				$sendMsg = true;
			} else if ($matchData->message_type == 'match_score' && SEND_MATCH_SCORE) {
				$title = 'Match Score';
				$payload['title'] = $matchData->message_data->event_name;
				$payload['text'] = matchDecode($matchData->message_data->match->comp_level) . ": " . $matchData->message_data->match->match_number . "-" . $matchData->message_data->match->match_number;
				$payloac['color'] = SLACK_SCORE_COLOR;
				$payload['redTitle'] = "Red Alliance - " . $matchData->message_data->match->alliances->red->score . " pts";
				$payload['blueTitle'] = "Blue Alliance - " . $matchData->message_data->match->alliances->blue->score . " pts";
				$teams['red'] = str_replace('frc','',$matchData->message_data->match->alliances->red->teams[0] . ', ' . $matchData->message_data->match->alliances->red->teams[1] . ', ' . $matchData->message_data->match->alliances->red->teams[2]);
				$teams['blue'] = str_replace('frc','',$matchData->message_data->match->alliances->blue->teams[0] . ', ' . $matchData->message_data->match->alliances->blue->teams[1] . ', ' . $matchData->message_data->match->alliances->blue->teams[2]);
				$sendMsg = true;
			}
			if ($sendMsg) {
				$client->attach([
					'title' 		=> $payload['title'],
					'title_link'	=> '',
					'fallback' 		=> $payload['title'],
					'text' 			=> $payload['text'],
					'color' 		=> $payload['color'],
					'fields' 		=> [
						[
							'title' => $payload['redTitle'],
							'value' => $teams['red'],
							'short' => true
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
}
// Save the contents to make sure we don't send the same message twice
file_put_contents(CHECK_SAME_FILE, json_encode($matchData));

/**
 * Change the match types into readable text
 * 
 * @param  	{String} 	$match 	Match type recieved from TBA
 * @return 	{String}		   	Readable match type (final, semifinal, quarterfinal, qualification)
 */
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
}
?>
