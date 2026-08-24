<?php
/**
 * Number of unread posts
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (! defined( 'IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	// User preferences
	'NOUP_UNREAD_POSTS' => [
		0 => 'Dieses Thema enthält keine ungelesenen Beiträge.',
        1 => 'Dieses Thema enthält einen ungelesenen Beitrag.',
        2 => 'Dieses Thema enthält %1s ungelesene Beiträge.',
    ],
	'NOUP_UNREAD_TOPICS' => [
        0 => 'Es gibt keine ungelesenen Beiträge.',
        1 => 'Es gibt ein Thema mit ungelesenen Beiträgen.',
        2 => 'Es gibt %1s Themen mit ungelesenen Beiträgen.',
	],
]);
