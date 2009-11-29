<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Michael Knabe <mk@e-netconsulting.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Register a new item in top toolbar to clear plugin cache
 * Add additional method to clear plugin cache on click on "Clear all caches" in top toolbar
 * Add additional method to clear plugin cache on clear all cache event
 *
 * @author  Michael Knabe <mk@e-netconsulting.de>
 * @author  Christian Kuhn <lolli@schwarzbu.ch>
 * @package TYPO3
 * @subpackage enetcache
 */

	// @TODO: Test if autoloader handles this
require_once($GLOBALS['BACK_PATH'] . 'interfaces/interface.backend_cacheActionsHook.php');

class tx_enetcache_backendContentCacheAction implements backend_cacheActionsHook {
	/**
	 * Clear plugin cache item in top toolbar
	 * This hook method is called by the cache action (the flash in top toolbar) with click on "Clear plugin cache"
	 *
	 * @param array cacheAction
	 * @param array optionValues
	 * @return void
	 */
	public function manipulateCacheActions(&$cacheActions, &$optionValues) {
		$cacheActions[] = array(
			'id'	=>	'clearContentCache',
			'title'	=>	'Clear plugin cache',
			'href'  =>  $GLOBALS['BACK_PATH'].'ajax.php?ajaxID=enetcache::clearContentCache',
			'icon'	=>	'<img width="16" height="16" title="Clear content element cache" alt="Clear content cache" src="../typo3conf/ext/enetcache/delete_pi.png" />'
		);
		$optionValues[] = 'clearContentCache';
	}

	/**
	 * Flush (empty) cache backend of enetcache (eg. db table or memcached)
	 * Helper method called by "Clear plugin cache" flash icon
	 *
	 * @return void
	 */
	public function clearContentCache() {
		t3lib_div::makeInstance('tx_enetcache')->flush();
	}

	/*
	 * This hook method is called by clearCacheCmd
	 * Will flush enetcache if "clear all cache" is called
	 * Works for pageTS clearAllCacheCMD actions and for flash icon "Clear all caches" in top toolbar
	 *
	 * @return void
	 */
	public function clearCachePostProc($params, $pObj) {
		if ($params['cacheCmd'] === 'all') {
			t3lib_div::makeInstance('tx_enetcache')->flush();
		}
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/enetcache/hooks/class.tx_enetcache_backendContentCacheAction.php'])  {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/enetcache/hooks/class.tx_enetcache_backendContentCacheAction.php']);
}