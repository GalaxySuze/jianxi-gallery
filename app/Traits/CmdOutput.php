<?php


namespace App\Traits;


use App\Support\Tool;

trait CmdOutput
{
    /**
     * @param $msg
     * @param $e
     */
    public function echoErr($msg, $e)
    {
        $this->error(
            Tool::errFormat($msg, $e)
        );
    }
}