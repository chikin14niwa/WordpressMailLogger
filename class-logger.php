<?php
namespace Plugin\WordpressMailLogger;

require_once(__DIR__ . '/class-log-data.php');

class Logger {
  /** @var mixed $fp */
  private $fp;

  /** @var string $dir */
  private $dir;

  public function __construct()
  {
    $this->fp = false;
    $this->dir = __DIR__ . '/log/';
  }

  public function __destruct()
  {
    if (!$this->fp) {
      fclose($this->fp);
    }
  }

  public function open($filename): bool
  {
    $this->fp = fopen($this->dir . $filename, 'a');
    if (!$this->fp) {
      return false;
    }

    return true;
  }

  public function write($data) {
    if (!$this->fp) {
      return;
    }
    fwrite($this->fp, json_encode($data) . "\n");
  }
}
