<?php
// Maxim VT
// maxeeem@gmail.com

class Settings {
    public $host;
    public $server_id;
    public $server_load_alarm;
    public $user;
    public $verbose;
    public $test_mode;
    public $debug_mode;
    public $log_file_path;
    public $send_notifications;
	
	public function loadDefaults() {
		$this->host = 'default.com';
		$this->server_id = 99999;
		$this->server_load_alarm = 0.5;
		$this->user = 'maxim';
		$this->verbose = false;
		$this->test_mode = false;
		$this->debug_mode = true;
		$this->log_file_path = '/nsa/logfile.log';
		$this->send_notifications = false;
	}	

	// All vars initialized to defaults
	public function __construct() {
		$this->loadDefaults();
	}

    // Load settings from file
    // returns bool indicating success
    public function loadSettingsFromFile($path) {
		$source = fopen($path, 'r');
		
		if ($source === false) {
			return false;
		}

		while (($line = fgets($source)) !== false) {
			$trimmed = trim($line);
			if (empty($trimmed) || $trimmed[0] == '#') {
				// skip empty lines and comments
				continue; 
			}

			$kv = explode('=', $trimmed);
			if (count($kv) != 2) {
				// invalid line
				continue;
			}

			$key = trim($kv[0]);
			$value = trim($kv[1]);

			if (!isset($this->$key)) {	
				// invalid key
				continue;
			}

			$type = gettype($this->$key);

			// booleans are special
			if ($type == 'boolean') {
				$value = strtolower($value); // to allow for things like True or YES
				if (in_array($value, ['true', 'yes', 'on'])) {
					$value = 1;
				} elseif (in_array($value, ['false', 'no', 'off'])) {
					$value = 0;
				} else {
					// invalid boolean
					continue;
				} 
			}

			if ($type == 'unknown type' || !settype($value, $type)) {
				// invalid type
				continue;
			}

			$this->$key = $value;
		}
		
		fclose($source);

        return true;
    }
}
?>
