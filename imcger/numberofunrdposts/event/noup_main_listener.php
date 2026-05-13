<?php
/**
 * Number of unread posts
 * An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2026, Thorsten Ahlers
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace imcger\numberofunrdposts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class noup_main_listener implements EventSubscriberInterface
{
	protected array	 $num_unrd_posts;
	protected array	 $num_unrd_topics;
	protected string $js_subforums_title;

	public function __construct
	(
		protected \phpbb\db\driver\driver_interface $db,
		protected \phpbb\template\template $template,
		protected \phpbb\language\language $language,
		protected \phpbb\config\config $config,
		protected \phpbb\user $user,
	)
	{
		$this->num_unrd_posts	  = [];
		$this->num_unrd_topics	  = [];
		$this->js_subforums_title = '';
	}

	public static function getSubscribedEvents(): array
	{
		return [
			'core.user_setup_after'					   => 'user_setup_after',
			'core.viewforum_modify_topics_data'		   => 'viewforum_modify_topics_data',
			'core.viewforum_modify_topicrow'		   => 'viewforum_modify_topicrow',
			'core.display_forums_modify_sql'		   => 'display_forums_modify_sql',
			'core.display_forums_modify_template_vars' => 'display_forums_modify_template_vars',
			'core.display_forums_after'				   => 'display_forums_after',
		];
	}

	public function user_setup_after(): void
	{
		$this->language->add_lang('noup_common', 'imcger/numberofunrdposts');
	}

	public function viewforum_modify_topics_data(object $event): void
	{
		if ($this->user->data['is_registered'] && $this->config['load_db_lastread'])
		{
			$this->num_unrd_posts = $this->get_num_unrd_posts($event['topic_list']);
		}
	}

	public function viewforum_modify_topicrow(object $event): void
	{
		$topic_row = $event['topic_row'];

		if (isset($this->num_unrd_posts[$topic_row['TOPIC_ID']]))
		{
			$topic_row['TOPIC_FOLDER_IMG_ALT'] = $this->language->lang('NOUP_UNREAD_POSTS', (int) $this->num_unrd_posts[$topic_row['TOPIC_ID']]);

			$event['topic_row'] = $topic_row;
		}
	}

	public function display_forums_modify_sql(): void
	{
		if ($this->user->data['is_registered'] && $this->config['load_db_lastread'])
		{
			$this->num_unrd_topics = $this->get_num_unrd_topics();
		}
	}

	public function display_forums_modify_template_vars(object $event): void
	{
		$forum_row			 = $event['forum_row'];
		$subforums_row		 = $event['subforums_row'];
		$forum_id			 = $forum_row['FORUM_ID'];
		$num_subforum_topics = 0;

		$forum_row['FORUM_FOLDER_IMG_ALT'] = $this->language->lang('NOUP_UNREAD_TOPICS', isset($this->num_unrd_topics[$forum_id]) ? (int) $this->num_unrd_topics[$forum_id] : 0);

		foreach ($subforums_row as $subforum)
		{
			$subforum_id		  = substr($subforum['U_SUBFORUM'], strpos($subforum['U_SUBFORUM'], 'f=') + 2);
			$num_subforum_topic	  = isset($this->num_unrd_topics[$subforum_id]) ? $this->num_unrd_topics[$subforum_id] : 0;
			$num_subforum_topics += $num_subforum_topic;

			$this->js_subforums_title .= '$("a[href=\'' . $subforum['U_SUBFORUM'] . '\']").attr("title", "' . $this->language->lang('NOUP_UNREAD_TOPICS', (int) $num_subforum_topic) . '");';
		}

		if ($num_subforum_topics)
		{
			$forum_row['FORUM_FOLDER_IMG_ALT'] = $this->language->lang('NOUP_UNREAD_TOPICS', (int) $num_subforum_topics);
		}

		$event['forum_row'] = $forum_row;
	}

	public function display_forums_after(): void
	{
		if ($this->js_subforums_title)
		{
			$this->template->assign_vars([
				'JS_SUBFORUMS_TITLE' => $this->js_subforums_title,
			]);
		}
	}

	public function get_num_unrd_posts(array $topic_list): array
	{
		if (empty($topic_list))
		{
			return [];
		}
		
		$sql_array = [
			'SELECT'	=> 'p.topic_id, COUNT(p.topic_id) AS unread_post_counter',
			'FROM'		=> [POSTS_TABLE => 'p',	],
			'LEFT_JOIN' => [
				[
					'FROM' => [TOPICS_TRACK_TABLE => 'tt', ],
					'ON'   => "tt.user_id = {$this->user->data['user_id']}
							AND tt.topic_id = p.topic_id",
				],
				[
					'FROM' => [FORUMS_TRACK_TABLE => 'ft', ],
					'ON'   => "ft.user_id = {$this->user->data['user_id']}
							AND ft.forum_id = p.forum_id",
				],
			],
			'WHERE'		=> $this->db->sql_in_set('p.topic_id', $topic_list) . "
						AND p.post_time > COALESCE(tt.mark_time, ft.mark_time, {$this->user->data['user_lastmark']}, 0)",
			'GROUP_BY'	=> 'p.topic_id',
		];

		$sql	 = $this->db->sql_build_query('SELECT', $sql_array);
		$result	 = $this->db->sql_query($sql);
		$row_set = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return array_combine(array_column($row_set, 'topic_id'), array_column($row_set, 'unread_post_counter'));
	}

	public function get_num_unrd_topics(): array
	{
		$sql_array = [
			'SELECT'	=> 't.forum_id, COUNT(t.topic_id) AS unread_topics_counter ',
			'FROM'		=> [TOPICS_TABLE => 't', ],
			'LEFT_JOIN' => [
				[
					'FROM' => [TOPICS_TRACK_TABLE => 'tt', ],
					'ON'   => "tt.user_id = {$this->user->data['user_id']}
							AND tt.topic_id = t.topic_id",
				],
				[
					'FROM' => [FORUMS_TRACK_TABLE => 'ft', ],
					'ON'   => "ft.user_id = {$this->user->data['user_id']}
							AND ft.forum_id = t.forum_id",
				],
			],
			'WHERE'		=> "t.topic_last_post_time > COALESCE(tt.mark_time, ft.mark_time, {$this->user->data['user_lastmark']}, 0)",
			'GROUP_BY'	=> 't.forum_id',
		];
		$sql	 = $this->db->sql_build_query('SELECT', $sql_array);

		$result	 = $this->db->sql_query($sql);
		$row_set = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		return array_combine(array_column($row_set, 'forum_id'), array_column($row_set, 'unread_topics_counter'));
	}
}
