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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, [
	// Check php and phpBB extension requirments
	'IMCGER_REQUIRE_SERVER_SIDE_MARKING' => 'Für die Funktion dieser Erweiterung muss die <u><a href="%s">Serverseitige Gelesen-Markierung</a></u> aktiviert sein.<br>Bitte aktualisiere deine Einstellungen.',
	'IMCGER_REQUIRE_PHP'		=> 'Deine php Version ist %1$s. Benötigt wird eine Version %2$s.',
	'IMCGER_REQUIRE_PHPBB'		=> 'Deine phpBB Version ist %1$s. Benötigt wird eine Version %2$s.',
]);
