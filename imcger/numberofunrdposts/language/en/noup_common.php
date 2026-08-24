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
		0 => 'This topic has no unread posts.',
		1 => 'There is one unread post in this topic.',
		2 => 'There are %1s unread posts in this topic.',
	],
	'NOUP_UNREAD_TOPICS' => [
		0 => 'There are no unread posts.',
		1 => 'There is one topic with unread posts.',
		2 => 'There are %1s topics with unread posts.',
	],
]);
