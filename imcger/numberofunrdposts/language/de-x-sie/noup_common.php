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
		1 => '%1s ungelesenen Beitrag',
		2 => '%1s ungelesene Beiträge',
	],
	'NOUP_UNREAD_TOPICS' => [
		0 => 'Keine ungelesene Themen',
		1 => '%1s ungelesenes Thema',
		2 => '%1s ungelesene Themen',
	],
]);
