<?php
namespace App\Exceptions;

use Log;

class ErrorException extends \Exception
{
	protected $code;
	protected $content;

	public function __construct($message, $code, $content = [])
	{
		$this->code = $code;
		$this->content = $content;

		// log exception
		Log::info($message, $content);

		parent::__construct($message);
	}

	public function getErrorCode()
	{
		return $this->code;
	}

	public function getContent($content)
	{
		return $this->content;
	}
}