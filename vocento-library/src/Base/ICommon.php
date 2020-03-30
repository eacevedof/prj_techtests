<?php
namespace League\Base;

interface ICommon
{
    public function get_teams();
    public function get_location();
    public function get_kickoff_time();
    public function get_result();
    public function get_status();
}
