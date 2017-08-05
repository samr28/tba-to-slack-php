# TBA To Slack (PHP)
## Installation
To install simply clone (or download) the repo and put the folder into the www directory of your webserver. If you don't have a webserver, please do a google search for ('lamp' - linux, 'wamp' - windows) webserver setup and make sure you have php installed.

## Setup
1. First go to [TBA my account page](https://www.thebluealliance.com/account)
2. Add a webhook as shown in the images below
[Click add webhook](https://github.com/samr28/tba-to-slack-php/img/TBA1.png "Click add webhook")
[Fill out the URL & name of webhook](https://github.com/samr28/tba-to-slack-php/img/TBA2.png "Fill out the URL & name of webhook")
   * Note: Leave secret blank, it will be filled out later
   * Note: The name of the webhook is completely arbitrary, just choose something so that you know what this webhook is for, like `tba to slack`
3. After clicking save, you should be redirected back to the account page. There should be a new entry in connected devices with the data that you put in. You will need to click on the verify button. Next check `verification.json` and find the `verification code`. Paste that into TBA and you should be verified.
4. Next go to Slack and add a new incoming webhook. Copy the hook URL and paste it into `tbaToSlack.php`.
5. Modyfy the constants at the top of `tbaToSlack.php`. You can change the bot name, channel it posts to and much more.
6. Finally, when you have everything configured, you can test and make sure everything is working by clicking on one of the buttons here: [TBA Webhooks API](https://www.thebluealliance.com/apidocs/webhooks).