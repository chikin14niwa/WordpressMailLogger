<?php

class AdminMenuOption
{
  private $pageTitle;
  private $menuTitle;
  private $capability;

  public function __construct()
  {
    $this->pageTitle = 'Wordpressメールロガー';
    $this->menuTitle = '設定';
    $this->capability = 'administrator';
  }

  public function setup($slug)
  {
    \add_menu_page(
      $this->pageTitle,
      $this->menuTitle,
      $this->capability,
      $slug,
      [$this, 'view'],
      '',
      85
    );
  }

  public function view()
  {
    $plugin_url = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__),'',plugin_basename(__FILE__));
    \wp_enqueue_script('wordpress-mail-loader-js', $plugin_url.'/js/wordpress-mail-logger.js', ['wp-element'], '0.0.1', true);
    echo '<div id="my-component-wrapper"></div>';
  }
}
