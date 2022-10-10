<?php
namespace Plugin\WordpressMailLogger;

class MailLog
{
  public $to;
  public $subject;
  // public $message;
  public $headers;
  // public $attachments;

  public function __construct($messageArgs)
  {
    $this->to = $messageArgs['to'];
    $this->subject = $messageArgs['subject'];
    // $this->message = $messageArgs['message'];
    $this->headers = $messageArgs['headers'];
    // $this->attachments = $messageArgs['attachments'];
  }
}

class ErrorLog
{
  public $code;
  public $message;
  public $data;

  public function __construct($error)
  {
    $this->code = $error->get_error_code();
    $this->message = $error->get_error_message();
    $this->maessage = $error->get_error_data($this->code);
  }
}

class LogData
{
  public $time;
  public $mailLog;
  public $errorLog;

  public function __construct($messageArgs, $error)
  {
    $this->time = date('Y-m-d H:i:s');
    $this->mailLog = !empty($messageArgs) ? new MailLog($messageArgs) : '';
    $this->errorLog = $error ? new ErrorLog($error) : '';
  }
}
