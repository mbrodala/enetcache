<?php
/***************************************************************
 * Copyright notice
 *
 * (c) 2011 Michael Knabe <mk@e-netconsulting.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test TCA setup for a table with references to other tables.
 */
return [
    'columns' => [
        'cust_deliveryaddress' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.cust_deliveryaddress',
            'config' => [
                'type' => 'user',
                'userFunc' => 'user_orderedit_func->delivery_adress',
            ]
        ],
        'order_type_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.order_type_uid',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['' => 0],
                ],
                'foreign_table' => 'tx_commerce_order_types',
                'default' => '',
            ]
        ],
        'order_id' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.order_id',
            'config' => [
                'type' => 'none',
                'pass_content' => 1,
            ]
        ],
        'crdate' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.crdate',
            'config' => [
                'type' => 'none',
                'format' => 'date',
                'eval' => 'date',
            ]
        ],
        'newpid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.pid',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'pages',
                'itemsProcFunc' =>'user_orderedit_func->order_status',
            ]
        ],
        'cust_fe_user' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.cust_fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'wizards' => [
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => [
                        'type' => 'popup',
                        'title' => 'Edit user',
                        'script' => 'wizard_edit.php',
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'edit2.gif',
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
        'cust_stuff' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.cust_fe_user',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'fe_users, ttt_content',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'wizards' => [
                    '_PADDING' => 1,
                    '_VERTICAL' => 1,
                    'edit' => [
                        'type' => 'popup',
                        'title' => 'Edit user',
                        'script' => 'wizard_edit.php',
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'edit2.gif',
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
        'cust_invoice' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.cust_invoice',
            'config' => [
                'type' => 'user',
                'userFunc' => 'user_orderedit_func->invoice_adress',
            ]
        ],
        'paymenttype' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.paymenttype',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_commerce_articles',
                'foreign_table_where' => ' AND tx_commerce_articles.article_type_uid = 2',
            ]
        ],
        'sum_price_net' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.sum_price_net',
            'config' => [
                'type' => 'user',
                'userFunc' => 'user_orderedit_func->order_articles',
            ]
        ],
        'sum_price_gross' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.sum_price_gross',
            'config' => [
                'type' => 'user',
                'userFunc' => 'user_orderedit_func->sum_price_gross_format',
            ]
        ],
        'payment_ref_id' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.payment_ref_id',
            'config' => [
                'type' => 'none',
                'pass_content' => 1,
            ],
        ],
        'cu_iso_3_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.cu_iso_3_uid',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'static_currencies',
                'foreign_table_where' => ' ',
                'default' => '49',
            ],
        ],
        'comment' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.comment',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
        'internalcomment' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.internalcomment',
            'config' => [
                'type' => 'text',
                'cols' => '30',
                'rows' => '5',
            ],
        ],
        'order_sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.php:LGL.default_value', 0]
                ]
            ]
        ],
        'pricefromnet' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:commerce/locallang_db.xml:tx_commerce_orders.pricefromnet',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['LLL:EXT:commerce/locallang_be.xml:no', 0],
                    ['LLL:EXT:commerce/locallang_be.xml:yes', 1]
                ]
            ],
        ],
    ],
];
