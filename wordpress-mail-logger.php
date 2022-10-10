<?php
/**
 * Plugin Name: Wordpress Mail Logger
 * Description: Save file when using wp_mail()
 * Version: 1.0
 * License: GPL v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Author: Hayato Nakamura
 * Author URI: https://github.com/chikin14niwa
 *
 * Wordpress Mail Logger is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Wordpress Mail Logger is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Wordpress Mail Logger. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
 */
namespace Plugin\WordpressMailLogger;

use AdminMenuOption;

if (!defined('WPINC')) {
  die;
}

require_once(__DIR__ . '/../../../wp-includes/pluggable.php');
require_once(__DIR__ . '/../../../wp-admin/includes/plugin.php');
require_once(__DIR__ . '/class-logger.php');
require_once(__DIR__ . '/class-admin-menu-option.php');

// 初期設定
$log_dir = __DIR__ . '/log';
if (!file_exists($log_dir)) {
  if (!mkdir($log_dir)) {
    die;
  }
}

// Adminページへのメニューの表示
$slug = 'wordpress_mail_logger';
$optionPage = new AdminMenuOption();
$optionPage->setup($slug);

function save_success($messageArgs)
{
  $filename = 'mail.log';
  $logger = new Logger();
  $logger->open($filename);
  $logger->write(new LogData($messageArgs, null));
}
\add_action('wp_mail', 'Plugin\\WordpressMailLogger\\save_success');

function save_failure($error)
{
  $filename = 'mail.log';
  $logger = new Logger();
  $logger->open($filename);
  $logger->write(new LogData([], $error));
}
\add_action('wp_mail_failed', 'Plugin\\WordpressMailLogger\\save_failure');
