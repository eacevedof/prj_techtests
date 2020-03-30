<?php
namespace League\Base;

interface IMatch
{
    public function get_players();
    public function get_score_player();
    public function get_score_time();
    public function get_player_card($color="yellow");
    public function get_card_time();
}