<?php
	namespace PortAdhoc;

	class Papertrail {
		const SEVERITY_EMERGENCY = 0;
		const SEVERITY_ALERT = 1;
		const SEVERITY_CRITICAL = 2;
		const SEVERITY_ERROR = 3;
		const SEVERITY_WARNING = 4;
		const SEVERITY_NOTICE = 5;
		const SEVERITY_INFORMATIONNAL = 6;
		const SEVERITY_DEBUG = 7;

		public static $program = null;
		public static $component = null;
		public static $message = null;
		public static $host = null;
		public static $port = null;
		public static $facility = null;

		protected static $severity = null;
		protected static $socket = null;
		protected static $syslog = null;
		protected static $splittedMessage = null;
		protected static $line = null;

		public static function program( $string ) {
			self::$program = (string) $string;

			return new self;
		}

		public static function component( $string ) {
			self::$component = (string) $string;

			return new self;
		}

		public static function message( $string ) {
			self::$message = (string) $string;

			return new self;
		}

		public static function port( $integer ) {
			self::$port = (int) $integer;

			return new self;
		}

		public static function host( $string ) {
			self::$host = (string) $string;

			return new self;
		}

		public static function severity( $integer ) {
			self::$severity = (int) $integer;

			return new self;
		}

		public static function facility( $integer ) {
			self::$facility = (int) $integer;

			return new self;
		}

		public static function send() {
			self::checkValues();
			self::setSocket();
			self::log();
		}

		private static function checkValues() {
			$properties = ['program', 'component', 'message', 'port', 'host', 'severity', 'facility'];

			foreach( $properties as $property ) {
				self::checkProperty( $property );
			}
		}

		private static function checkProperty( $string ) {
			if( empty(self::$$string) ) {
				throw new InvalidArgumentException("property $string should not be empty");
			}
		}

		private static function setSocket() {
			self::$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

			if( ! self::$socket ) {
	  			$message = socket_strerror( socket_last_error() );
	  			
	  			throw new Exception( $message );
	  		}
		}

		private static function log() {
			self::setSplitedMessage();

			foreach(self::$splittedMessage as self::$line) {
	    		self::$syslog = self::setSyslog();
	    		
	    		self::sendSocket();
	  		}
		}

		private static function setSyslog() {
			return "<" . ((self::$facility * 8) + self::$severity) . ">" . date('M d H:i:s ') . self::$program . ' ' . self::$component . ': ' . self::$line;
		}

		private static function sendSocket() {
			$octets = socket_sendto(self::$socket, self::$syslog, strlen(self::$syslog), 0, self::$host, self::$port);

			if( ! $octets ) {
				throw new RuntimeException('could not send socket to ' . self::$host . ' on port ' . self::$port);
			}
		}

		private static function setSplitedMessage() {
			self::$splittedMessage = explode("\n", self::$message);
		}
	}
?>