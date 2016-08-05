<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Load settings from file</title>
<head></head>
<body>

<?php

// Maxim VT
// maxeeem@gmail.com

require 'Settings.php';

$path = './settings.conf';

// at app load we can try to load custom settings
// defaults are used if we encountered a problem

$currentSettings = new Settings();

print('<h4>Current settings:</h4>');
echo '<pre>';
var_export($currentSettings);
echo '</pre>';


print('<br /><br />Attempting to load new settings...');

if ($currentSettings->loadSettingsFromFile($path)) {
	print(' <b>Success!</b>');
	print('<h4>New settings:</h4>');
	echo '<pre>';
	var_export($currentSettings);
	echo '</pre>';	
} else {
	print(' <b>Error!</b>');
	print('<h4>Invalid settings file</h4>');
}


print('<br /><p>We can also access individual items by name:</p>');
echo '<ul>';
echo '<li>Host: ' . $currentSettings->host . '</li>';
echo '<li>Username: ' . $currentSettings->user . '</li>';
echo '</ul>'

?>

</body>
</html>
