<?php 
	namespace Magic\Engine\Datamgr\Driver;
	use Magic\Engine\Datamgr\DbManager;
	class DbDriverFactory
	{
		protected $driver;
		function __construct($driver)
		{
			
			$this->driver = $driver;
		}
		static function checkDriver($driver){
			if (!is_dir(path_root."/Engine/Datamgr/Driver/$driver")) {
				throw new UnexpectedValueException("Database driver folder not found: ".path_root."/Engine/Datamgr/Driver/$driver", 1);
			}
		}
		static function getClass($class,$params,$driver=false){
			global $registry;
			$config = $registry->get("config");
			if (!$driver) {
				$driver = $config->database->get("db_driver");
			}
			self::checkDriver($driver);
			$class = "Magic\\Engine\\Datamgr\\Driver\\".$driver."\\$class";
			$r = new \ReflectionClass($class);
			$class = $r->newInstanceArgs($params);
			return $class;
		}

		static function getDbSelect(DbManager $db,$table,$fields="*",$driver=false){
			return self::getClass("DbSelect",array($db,$table,$fields),$driver);
		}
		static function getDbInsert(DbManager $db,$table,$fields="*",$driver=false){
			return self::getClass("DbInsert",array($db,$table,$fields),$driver);
		}
		static function getDbUpdate(DbManager $db,$table,$fields="*",$driver=false){
			return self::getClass("DbUpdate",array($db,$table,$fields),$driver);
		}
		static function getDbDelete(DbManager $db,$table,$driver=false){
			return self::getClass("DbDelete",array($db,$table),$driver);
		}
	}
?>