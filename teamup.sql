-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 02 2019 г., 10:24
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `teamup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `measure_id` int(10) UNSIGNED NOT NULL,
  `graph_type` enum('straight','reverse') COLLATE utf8mb4_unicode_ci NOT NULL,
  `graph_color` enum('red','yellow','blue','violet','orange','green','indigo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('default','custom') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`id`, `name`, `measure_id`, `graph_type`, `graph_color`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Bessie Harris', 1, 'reverse', 'green', 'custom', 1, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(2, 'Lemuel Stoltenberg', 2, 'straight', 'red', 'default', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(3, 'Prof. Mervin Steuber', 3, 'straight', 'blue', 'custom', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(4, 'Boris Schamberger I', 4, 'straight', 'yellow', 'default', 1, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(5, 'Harmon Buckridge', 5, 'reverse', 'violet', 'default', 1, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(6, 'Lucious Kemmer', 6, 'reverse', 'violet', 'default', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(7, 'Vicky O\'Connell', 7, 'reverse', 'yellow', 'default', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(8, 'Prof. Rico Kuhn', 8, 'straight', 'violet', 'custom', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(9, 'Drew Kling', 9, 'straight', 'green', 'custom', 1, '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(10, 'Chasity Cruickshank IV', 10, 'reverse', 'violet', 'default', 2, '2019-04-01 13:39:25', '2019-04-01 13:39:25');

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `feedback` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` enum('read','unread') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `feedback`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'THAT is--\"Take care of themselves.\"\' \'How fond she is such a tiny little thing!\' It did so indeed, and much sooner than she had plenty of time as she picked her way out. \'I shall sit here,\' he said.', '1975-12-07', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(2, 2, 'And here Alice began to repeat it, but her head to hide a smile: some of them at last, and they lived at the righthand bit again, and looking at them with the Lory, who at last she stretched her.', '1974-03-03', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(3, 2, 'I never understood what it might not escape again, and put it in less than a pig, and she had tired herself out with his tea spoon at the door-- Pray, what is the same height as herself; and when.', '1985-01-10', 'read', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(4, 1, 'THEIR eyes bright and eager with many a strange tale, perhaps even with the Gryphon. \'I\'ve forgotten the Duchess by this very sudden change, but very politely: \'Did you say pig, or fig?\' said the.', '1992-04-29', 'read', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(5, 2, 'Mouse. \'Of course,\' the Dodo could not remember ever having seen in her pocket) till she had sat down with wonder at the jury-box, or they would go, and broke to pieces against one of the way the.', '1975-04-20', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(6, 1, 'Cat,\' said Alice: \'three inches is such a thing. After a time she had asked it aloud; and in his turn; and both the hedgehogs were out of the room again, no wonder she felt unhappy. \'It was much.', '2009-07-02', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(7, 1, 'Mock Turtle Soup is made from,\' said the Dormouse followed him: the March Hare. \'He denies it,\' said Alice, \'we learned French and music.\' \'And washing?\' said the Duck. \'Found IT,\' the Mouse to tell.', '1972-08-21', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(8, 1, 'Alice replied in an undertone to the Caterpillar, just as if it makes me grow large again, for this curious child was very like having a game of croquet she was coming to, but it makes me grow.', '1972-03-04', 'read', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(9, 1, 'And he added looking angrily at the March Hare. \'It was the White Rabbit hurried by--the frightened Mouse splashed his way through the door, she ran off as hard as it settled down again very sadly.', '1982-08-18', 'unread', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(10, 1, 'Dormouse fell asleep instantly, and neither of the ground, Alice soon came to the three gardeners instantly jumped up, and began staring at the White Rabbit; \'in fact, there\'s nothing written on the.', '1996-06-11', 'read', '2019-04-01 13:39:25', '2019-04-01 13:39:25');

-- --------------------------------------------------------

--
-- Структура таблицы `goals`
--

CREATE TABLE `goals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `goal` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `measures`
--

CREATE TABLE `measures` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `measures`
--

INSERT INTO `measures` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Nia Kerluke', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(2, 'Fred Douglas', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(3, 'Mrs. Ivy King', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(4, 'Alexa Bins DDS', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(5, 'Mrs. Bonnie Kohler', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(6, 'Reinhold Cummerata', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(7, 'Frederick Dietrich V', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(8, 'Ervin Feil', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(9, 'Candace Dooley', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(10, 'Prof. Alf Rosenbaum IV', '2019-04-01 13:39:25', '2019-04-01 13:39:25');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_02_28_103636_create_measures_table', 1),
(9, '2019_02_28_104154_create_activities_table', 1),
(10, '2019_02_28_124205_create_notes_table', 1),
(11, '2019_02_28_124558_create_records_table', 1),
(12, '2019_02_28_125315_create_teams_table', 1),
(13, '2019_02_28_130210_create_team_user_table', 1),
(14, '2019_02_28_130551_create_notices_table', 1),
(15, '2019_02_28_131800_create_settings_table', 1),
(16, '2019_02_28_135710_create_goals_table', 1),
(17, '2019_03_01_114130_create_feedbacks_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `note`, `user_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Alice, \'shall I NEVER get any older than you, and must know better\'; and this was of very little way out of the Gryphon, \'you first form into a pig,\' Alice quietly said, just as I do,\' said the.', 1, '1997-12-09', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(2, '1', 2, '2009-01-12', '2019-04-01 13:39:25', '2019-04-01 14:34:02'),
(3, 'Queen said--\' \'Get to your little boy, And beat him when he sneezes: He only does it to his son, \'I feared it might end, you know,\' said the King, and the party sat silent for a dunce? Go on!\' \'I\'m.', 2, '1994-04-20', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(4, 'Mystery,\' the Mock Turtle, capering wildly about. \'Change lobsters again!\' yelled the Gryphon in an angry tone, \'Why, Mary Ann, and be turned out of sight: \'but it seems to like her, down here, and.', 2, '1997-09-08', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(5, 'THIS size: why, I should like to have any rules in particular; at least, if there are, nobody attends to them--and you\'ve no idea what to say \"HOW DOTH THE LITTLE BUSY BEE,\" but it just now.\' \'It\'s.', 1, '1997-05-27', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(6, 'So Alice got up and said, \'It WAS a narrow escape!\' said Alice, \'a great girl like you,\' (she might well say this), \'to go on in a thick wood. \'The first thing she heard it say to itself, \'Oh dear!.', 1, '1999-04-29', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(8, 'Gryphon. Alice did not at all know whether it was as much as she could, for her to carry it further. So she began thinking over other children she knew she had looked under it, and finding it very.', 1, '1982-06-29', '2019-04-01 13:39:25', '2019-04-01 13:39:25'),
(10, 'Heads below!\' (a loud crash)--\'Now, who did that?--It was Bill, I fancy--Who\'s to go down--Here, Bill! the master says you\'re to go down the bottle, saying to herself, \'Now, what am I then? Tell me.', 1, '2009-01-01', '2019-04-01 13:39:25', '2019-04-01 13:39:25');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, 1, 'TeamUp', 'TqQxKuRZPeqMW9ygZpOlXHwlX0taZ3chI4mlFuBt', 'http://localhost:8000/auth/callback', 0, 0, 0, '2019-04-02 07:24:03', '2019-04-02 07:24:03');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` double(8,2) NOT NULL,
  `notice` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_graph_straight` text COLLATE utf8mb4_unicode_ci,
  `type_graph_reverse` text COLLATE utf8mb4_unicode_ci,
  `privacy_policy` text COLLATE utf8mb4_unicode_ci,
  `default_units` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `count` smallint(6) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `team_user`
--

CREATE TABLE `team_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('athlete','coach','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_students` smallint(6) DEFAULT NULL,
  `activation_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `activation` enum('full','demo','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'demo',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `player_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push` enum('enabled','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'enabled',
  `push_chat` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `type`, `avatar`, `number_students`, `activation_code`, `expiration_date`, `activation`, `status`, `player_id`, `push`, `push_chat`, `email_verified_at`, `phone`, `school`, `password_reset_code`, `created_at`, `updated_at`) VALUES
(1, 'Станислав', 'Андреевич', 'admin@admin.com', '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', 'swhhKPodOJ9q09inK7EA5tcvFodMGC3o2qR2IVBMavUSLSpv3NG9iT77vPt1', 'admin', '/avatars/24df642906350a4a377b4483cc5c3bf7.jpg', 148, '08s3579p71jnf03z2ady', '2019-04-02', 'demo', 'active', NULL, 'disabled', 'false', '2019-04-01 13:39:25', NULL, NULL, NULL, NULL, NULL),
(2, 'Станислав', 'Андреевич', 'coach@admin.com', '$2y$10$GlmMdEEq9DXG3lGnj2PrU.TeRy88/TXl7ZQFUcaF0hYpgJJwxwiS2', '9508RT0Sdy', 'coach', '/avatars/owl-mascot.png', 124, 'k78g07yoh623341jf0s9', '2019-04-10', 'demo', 'active', NULL, 'disabled', 'true', '2019-04-01 13:39:25', NULL, NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_measure_id_foreign` (`measure_id`),
  ADD KEY `activities_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goals_user_id_foreign` (`user_id`),
  ADD KEY `goals_activity_id_foreign` (`activity_id`);

--
-- Индексы таблицы `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `measures_name_unique` (`name`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `records_activity_id_foreign` (`activity_id`),
  ADD KEY `records_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_code_unique` (`code`),
  ADD KEY `teams_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_user_team_id_foreign` (`team_id`),
  ADD KEY `team_user_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_player_id_unique` (`player_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `measures`
--
ALTER TABLE `measures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `goals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `team_user`
--
ALTER TABLE `team_user`
  ADD CONSTRAINT `team_user_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `team_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
