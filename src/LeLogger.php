<?php

class LeLogger
{
	//Some standard log levels
	const ERROR = 0;
	const WARN = 1;
	const NOTICE = 2;
	const INFO = 3;
	const DEBUG = 4;

	const STATUS_SOCKET_OPEN = 1;
	const STATUS_SOCKET_FAILED = 2;
	const STATUS_SOCKET_CLOSED = 3;

	// Logentries server address for receiving logs
	const LE_ADDRESS = 'api.logentries.com';
	// Logentries server port for receiving logs by token
	const LE_PORT = 10000;

	private $_socket = null;

	private $_severityThreshold = self::INFO;

	private $_loggerName = null;

	private $_logToken = null;
	
	private $_timestampFormat = 'Y-m-d G:i:s';
	
	private static $instances = array();

	public static function instance($loggerName, $token)
	{
		if (in_array($loggerName, self::$instances)) {
			return self::$instances[$loggerName];
		}

		self::$instances = new self($loggerName, $token);

		return self::$instances[$loggerName];
	}

	public function __construct($loggerName, $token)
	{
		$this->_logToken = $token;		

		//Make socket
		$this->_createSocket();
	}

	public function __destruct()
	{
		if ($this->_socket) {
			socket_close($this->_socket);
		}
	}

	public function _createSocket()
	{
		$this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		
		socket_connect($this->_socket, 'api.logentries.com', 10000);

		$this->log("Opened connection", self::INFO);
	}

	public function Info($line)
	{
		$this->log($line, self::INFO);
	}

	public function log($line, $severity)
	{
		if ($this->_socket === null)
		{
			$this->_createSocket();
		}

		if ($this->_severityThreshold >= $severity) {
			$prefix = $this->_getTime($severity);

			$line = $prefix . $line;

			$this->writeToSocket($line . PHP_EOL);
		}
	}

	public function writeToSocket($line)
	{
		$finalLine = $this->_logToken . $line;

		socket_write($this->_socket, $finalLine, strlen($finalLine));	
	}

	private function _getTime($level)
	{
		$time = date(self::$_timestampFormat);

		switch ($level) {
			case self::INFO:
				return "$time  INFO - ";
			case self::WARN:
				return "$time - WARN - ";
			case self::ERROR:
				return "$time - ERROR - ";
			case self::NOTICE:
				return "$time - NOTICE - ";
			case self::DEBUG:
				return "$time - DEBUG - ";
			default:
				return "$time - LOG - ";
		}
	}
}
?>
