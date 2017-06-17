<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Add a new cache configuration if not already set in localconf.php
if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_enetcache_contentcache'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_enetcache_contentcache'] = [];
}
// Use StringFrontend if not set otherwise, if not set, core would choose variable frontend
if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_enetcache_contentcache']['frontend'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_enetcache_contentcache']['frontend'] = \TYPO3\CMS\Core\Cache\Frontend\StringFrontend::class;
}

// Define caches that have to be tagged and dropped
$TYPO3_CONF_VARS['EXTCONF']['enetcache']['TAG_CACHES'] = [
    'cache_enetcache_contentcache',
    'cache_pages',
];

// Initialize array for hooks. Other extensions can register here
if (!isset($TYPO3_CONF_VARS['EXTCONF']['enetcache']['hooks']['tx_enetcache'])) {
    $TYPO3_CONF_VARS['EXTCONF']['enetcache']['hooks']['tx_enetcache'] = [];
}

// Configure BE hooks
if (TYPO3_MODE == 'BE') {
    // Add the "Delete plugin cache" button and its functionality
    $TYPO3_CONF_VARS['BE']['AJAX']['enetcache::clearContentCache'] = \Lolli\Enetcache\Hooks\BackendContentCacheMethods::class . '->clearContentCache';
    $TYPO3_CONF_VARS['SC_OPTIONS']['additionalBackendItems']['cacheActions'][] = \Lolli\Enetcache\Hooks\BackendToolbarClearContentCache::class;

    // Drop cache tag handling in DataHandler on changing / inserting / adding records
    $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['enetcache'] = \Lolli\Enetcache\Hooks\DataHandlerFlushByTag::class;
    $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['enetcache'] = \Lolli\Enetcache\Hooks\DataHandlerFlushByTag::class;

    // Scheduler task to drop cache entries by tags
    $TYPO3_CONF_VARS['SC_OPTIONS']['scheduler']['tasks'][\Lolli\Enetcache\Tasks\DropTagsTask::class] = [
        'extension' => 'enetcache',
        'title' => 'LLL:EXT:enetcache/locallang.xml:scheduler.droptags.name',
        'description' => 'LLL:EXT:enetcache/locallang.xml:scheduler.droptags.description',
        'additionalFields' => \Lolli\Enetcache\Tasks\DropTagsAdditionalFieldProvider::class,
    ];

    // CLI script to drop cache entries by tags
    $TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys']['enetcache'] = [
        'EXT:enetcache/cli/class.tx_enetcache_cli.php', '_CLI_enetcache'
    ];
}
