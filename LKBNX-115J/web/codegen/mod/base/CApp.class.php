<?php
//==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>==>>>
//
// Ajaxいいねボタン v1.15 [ GPL ]
// Copyright (c) phpkobo.com ( http://jpn.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : LKBNX-115J
//
//==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<==<<<

//-- v1.16 [2016-02-12]
class CApp {

	public static $_rtc = null;
	private static $attr = array();
	private static $b_abort = false;

	public static function getAbort() {
		return self::$b_abort;
	}

	public static function setAbort() {
		self::$b_abort = true;
	}

	public static function get( $key ) {
		if ( isset( self::$attr[$key] ) ) {
			return self::$attr[$key];
		} else {
			return null;
		}
	}

	public static function set( $key, $val ) {
		self::$attr[$key] = $val;
	}

	public static function normPath( $path ) {
		if ( strpos( $path, "/../" ) !== false ) {
			$px = explode( "/", $path );
			$rx = array();
			foreach( $px as $p ) {
				if ( $p == "." ) {
					// do nothing
				} else if ( $p == ".." ) {
					array_pop($rx);
				} else {
					$rx[] = $p;
				}
			}
			$path = implode( "/",  $rx );
		}
		return $path;
	}

	public static function exeMain( $prefix, $mname ) {
		CRoll::checkAccess($mname);
		CModule::connect($mname);
		$cname = "{$prefix}_{$mname}";
		$cname = str_replace( "-", "_", $cname );
		$obj = new $cname;
		$obj->mname = $mname;
		$obj->mod =& CModule::$mods[$mname];
		$obj->main();
	}

	public static function vurl( $rtp = null, $params = null ) {
		if ( strpos( $rtp, "/" ) !== false ) {
			return $rtp;
		}

		$b = isset($_GET['_rt']);
		$q = false;

		$url = self::$_rtc['url-vroot'];
		if ( $b ) {
			if ( !empty($rtp) ) {
				$url .= $rtp;
			}
			if ( !empty($params) ) {
					$url .= "?{$params}";
			}
		} else {
			$url .= "index.php";
			if ( !empty($rtp) ) {
				$url .= "?_rtp={$rtp}";
				if ( !empty($params) ) {
					$url .= "&{$params}";
				}
			} else {
				if ( !empty($params) ) {
					$url .= "?{$params}";
				}
			}
		}

		return $url;
	}

	public static function vself( $params = null ) {
		return self::vurl( CApp::$_rtc['vrtp'], $params );
	}

	public static function run( &$_rtc ) {
		self::$_rtc =& $_rtc;
		if ( empty(self::$_rtc['vrtp']) ) {
			self::$_rtc['vrtp'] = '';
		}
		$vrtp = self::$_rtc['vrtp'];

		if ( $name = CModule::findMod($vrtp) ) {
			self::exeMain( 'CAction', $name );
		} else {
			self::setAbort();
		}

		if ( self::getAbort() ) {
			$name = "notfound";
			if ( isset(CModule::$mods[$name]) ) {
				if (( isset(CModule::$mods[$name]["dir"]) ) &&
					( CModule::$mods[$name]["dir"] == 404 )) {
					header("HTTP/1.0 404 Not Found");
					exit();
				}
			} else {
				self::$_rtc['b-processed'] = false;
				return 0;
			}
		}

		//-- override cca
		$mod = CModule::$mods[$name];
		if ( isset($mod['cca']) ) {
			$_rtc['cca'] = $_rtc['cca'] && $mod['cca'];
		}

		return 1;
	}

}

?>