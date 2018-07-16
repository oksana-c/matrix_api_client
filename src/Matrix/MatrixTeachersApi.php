<?php

/**
 * @file
 * Matrix Teachers Api.
 */

/**
 * Matrix Teachers Api.
 */
class MatrixTeachersApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Get teachers for class.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of user info about the teachers in the specified course. Each
   *   user info includes an additional 'coteacher' field that is true if the
   *   user is a co-teacher.
   */
  public function getTeachersForClass($class_id) {
    return $this->get('get_teachers_for_class', ['class_id' => $class_id]);
  }

  /**
   * Add the specified users as instructors of the specified course.
   *
   * This API either succeeds completely or fails completely - if an errors
   * occur, no users are added as instructors.
   *
   * @param string $class_id
   *   Class Id.
   * @param string $user_ids
   *   Used Ids separated by commas.
   *
   * @return mixed
   *   If successful, the number of users that were added is returned.
   */
  public function addTeachersToClass($class_id, $user_ids) {
    return $this->get('add_teachers_to_class', ['class_id' => $class_id, 'user_ids' => $user_ids]);
  }

  /**
   * Remove the specified users as instructors from the specified course.
   *
   * @param string $class_id
   *   Class Id.
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   If successful, the number of users that were removed is returned.
   */
  public function removeTeachersFromClass($class_id, $user_ids) {
    return $this->get('remove_teachers_from_class', ['class_id' => $class_id, 'user_ids' => $user_ids]);
  }

  /**
   * Get classes taught by user.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   Array of info about the courses taught by the specified user.
   *   Each course info includes an additional 'coteacher' field that is true
   *   if the user is a co-teacher.
   */
  public function getClassesTaughtBy($user_id) {
    return $this->get('get_classes_taught_by', ['user_id' => $user_id]);
  }

}
