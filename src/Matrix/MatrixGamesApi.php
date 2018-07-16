<?php

/**
 * @file
 * Matrix Games Api.
 */

/**
 * Matrix Games Api.
 */
class MatrixGamesApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * LMS Games.
   *
   * Game info has the following fields:
   * id - Unique game ID.
   * name - Name
   * description - Description
   * levels - Array of level info of the form ['name' => name,
   * 'points' => points].
   * enable_leaderboard - True if the leaderboard is enabled, otherwise false.
   * leaderboard_size - The size of the leaderboard if enabled.
   * show_to_students - True if the leaderboard should be shown to students,
   * otherwise false.
   * include_completed_students - True if students that have completed the
   * class should be included in the leaderboard, otherwise false.
   *
   * Player info has the following fields:
   * user_id - ID of the player.
   * points - The player's points.
   * level - The name of the player's level.
   * badges - Array of badge info of the form ['id' => badge ID,
   * 'name' => badge name, 'awarded_at' => time]
   */

  /**
   * Get games for site.
   *
   * @return mixed
   *   Array of game info about all site-wide games.
   */
  public function getGamesForSite() {
    return $this->get('get_games_for_site');
  }

  /**
   * Get games for site.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of game info about all the games in the specified course.
   */
  public function getGamesForClass($class_id) {
    return $this->get('get_games_for_class', ['class_id' => $class_id]);
  }

  /**
   * Get status for all players for the specified game.
   *
   * @param string $game_id
   *   Game Id.
   *
   * @return mixed
   *   Array of player info about all players in the specified game.
   */
  public function getStatusForAllPlayers($game_id) {
    return $this->get('get_status_for_all_players', ['game_id' => $game_id]);
  }

  /**
   * Get status for specified players for the specified game.
   *
   * @param string $game_id
   *   Game Id.
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   Array of player info about the specified players in the specified game.
   */
  public function getStatusForPlayers($game_id, $user_ids) {
    return $this->get('get_status_for_players', ['game_id' => $game_id, 'user_ids' => $this->toArray($user_ids)]);
  }

}
