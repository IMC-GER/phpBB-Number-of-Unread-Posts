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
		1 => '%1s unread post',
		2 => '%1s unread posts',
	],
	'NOUP_UNREAD_TOPICS' => [
		0 => 'No unread topics',
		1 => '%1s unread topic',
		2 => '%1s unread topics',
	],
]);
