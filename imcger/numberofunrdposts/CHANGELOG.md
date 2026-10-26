# Number of unread posts

## Changelog
- v1.0.2 26.10.2026
  - Fixed: The number of unread topics from grandchild forums are not included in the count.
  - Fixed: The number of unread topics/posts count from invisible posts.
  - Added: Check in `ext.php` that “Enable server-side topic marking” is enabled.
  - Changed: Check requirments with class `imcger_ext_requirements`.
  - Changed: Don't change title in links and moved topics.
  - Changed: Specifier in language string change to number.
  - Changed: Parse the subforum URL-query-parameters and extract the 'f' value.
  - Changed: Checking whether subforums are allowed for the user.
  - Changed: Only change tooltip when user is registered and “Enable server-side topic marking” is active.

- v1.0.1 24.09.2026
  - Changed: Use TWIG to build the JavaScript code in the template.

- v1.0.0 06.09.2026

## License
[GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
