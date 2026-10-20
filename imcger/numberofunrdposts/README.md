# Number of unread posts
![Index view](https://raw.githubusercontent.com/IMC-GER/images/refs/heads/main/screenshots/numberofunrdposts/numberofunrdposts.gif)
## Description
This phpBB extension add the number of unread posts and topics to the tooltip in the forum and index view. 

## Requirements
- phpBB >= 3.3.1 and < 4.0.0-dev
- php 8.0.0 or higher
- "Enable server-side topic marking" must be active.

## Changelog
- v1.0.2-b2 20.10.2026
  - Fixed: The number of unread topics from the grandchild forums will not be added.
  - Changed: Don't change title in links and moved topics.
  - Changed: Specifier in language string.
  - Changed: Parse url to get forum id from subforum.
  - Changed: Checking whether subforums are allowed for the user.
  - Changed: Only change tooltip when user is registered and `load_db_lastread` is active.

- v1.0.1 24.09.2026
  - Changed: Use TWIG to build the JavaScript code in the template.

- v1.0.0 06.09.2026

## License
[GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
