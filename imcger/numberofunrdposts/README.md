# Number of unread posts
![Index view](https://raw.githubusercontent.com/IMC-GER/images/refs/heads/main/screenshots/numberofunrdposts/numberofunrdposts.gif)
## Description
This phpBB extension add the number of unread posts and topics to the tooltip in the forum and index view. 

## Requirements
- phpBB >= 3.3.1 and < 4.0.0-dev
- php 8.0.0 or higher

## Changelog
- v1.0.0 06.09.2026

- v1.0.0-b5 27.08.2026
  - Update GNU GENERAL PUBLIC LICENSE
  - Improve sql-query for unread topics
    * Search only the necessary forums
    * Changed core event to get forum ids
  - Fixed topic counter for forums with subforum

- v1.0.0-b4 25.08.2026
  - Added: Support for the search results.
  - Changed: Replaced the short ternary operator with the null coalescing operator.
  - Changed: The language variables have been improved.
  
- v1.0.0-b3 15.08.2026
  - Added: Support for `Recent Topics NG` and `Recent Topics V3.x`.
  
- v1.0.0-b2 13.05.2026
  - Fixed: SQL Error when forum without topics
  - Typo in `readme.md`
  
- v1.0.0-b1 10.05.2026

## License
[GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
