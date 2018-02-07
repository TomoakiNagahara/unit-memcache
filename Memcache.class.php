<?php
/**
 * unit-memcache:/Memcache.class.php
 *
 * @creation  2018-02-07
 * @version   1.0
 * @package   unit-memcache
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @creation  2018-02-07
 */
namespace OP\UNIT;

/** Memcache
 *
 * @creation  2018-02-07
 * @version   1.0
 * @package   unit-memcache
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
class Memcache
{
	/** trait
	 *
	 */
	use \OP_CORE;

	/** Memcached Object.
	 * @var \Memcached
	 */
	static $_memcached;

	private static function _Hash($key)
	{
		return Hasha1( \Env::Get(_OP_APP_ID_) .'.'. $key);
	}

	/** Connection.
	 *
	 */
	static function Connect()
	{
		//  ...
		if( self::$_memcached === false ){
			$io = false;
		}else

		//  ...
		if(!$io = self::$_memcached = new \Memcached() ){
			self::$_memcached = false;
		}else

		//  ...
		if(!$io = self::$_memcached->addServer('localhost', 11211) ){
			self::$_memcached = false;
		}else{
			//  ...
		}

		//  ...
		return $io;
	}

	/** Get value.
	 *
	 * @param  string $key
	 * @return mixed  $value
	 */
	static function Get($key)
	{
		//  ...
		if( self::$_memcached === null ){
			self::Connect();
		}

		//  ...
		if( self::$_memcached === false ){
			return null;
		}

		return self::$_memcached->get(self::_Hash($key));
	}

	/** Set value.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 * @param  integer $expire
	 */
	static function Set($key, $value, $expire=1)
	{
		//  ...
		if( self::$_memcached === null ){
			self::Connect();
		}

		//  ...
		if( self::$_memcached === false ){
			return;
		}

		//  ...
		self::$_memcached->set(self::_Hash($key), $value, $expire);
	}
}
