<?php
$EM_CONF['enetcache'] = [
    'title' => 'Plugin cache engine',
    'description' => 'Provides an interface to cache plugin content elements',
    'category' => 'Frontend',
    'version' => '4.0.0',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Christian Kuhn',
    'author_email' => 'lolli@schwarzbu.ch',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'php' => '7.2.0-7.4.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
