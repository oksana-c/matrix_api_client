<?php

/**
 * @file
 * Matrix Students Api.
 */

/**
 * Matrix Students Api.
 */
class MatrixStudentsApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Get students for class.
   *
   * @param string $class_id
   *   Class id.
   *
   * @return mixed
   *   Array of student info about the students in the specified course.
   */
  public function getStudentsForClass($class_id) {
    return $this->get('get_students_for_class', ['class_id' => $class_id]);
  }

  /**
   * Enroll the specified users into the specified class.
   *
   * @param string $class_id
   *   Class id.
   * @param array $user_ids
   *   Array of User Ids.
   *
   * @return mixed
   *   If successful, the number of users that were enrolled is returned.
   *   This API either succeeds completely or fails completely - if an errors
   *   occur, no users are enrolled.
   */
  public function addStudentsToClass($class_id, array $user_ids) {
    return $this->get('add_students_to_class', ['class_id' => $class_id, 'user_ids' => $user_ids]);
  }

  /**
   * Unenroll the specified users from the specified class.
   *
   * @param string $class_id
   *   Class id.
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   If successful, the number of users that were unenrolled is returned.
   */
  public function removeStudentsFromClass($class_id, $user_ids) {
    return $this->get('remove_students_from_class', ['class_id' => $class_id, 'user_ids' => $user_ids]);
  }

  /**
   * Deactivate the specified students in the specified reactivate.
   *
   * @param string $class_id
   *   Class id.
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   If successful, the number of users that were deactivated is returned.
   */
  public function deactivateStudentsInClass($class_id, $user_ids) {
    return $this->get('deactivate_students_in_class', array('class_id' => $class_id, 'user_ids' => $user_ids));
  }

  /**
   * Reactivate the specified students in the specified course.
   *
   * @param string $class_id
   *   Class id.
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   If successful, the number of users that were reactivated is returned.
   */
  public function reactivateStudentsInClass($class_id, $user_ids) {
    return $this->get('reactivate_students_in_class', ['class_id' => $class_id, 'user_ids' => $user_ids]);
  }

  /**
   * Get status of user classes.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   Three arrays of class IDs for the specified user, in the form
   *   'enrolled' => [class ids], 'deactivated' => [class ids],
   *   'completed' => [class ids].
   */
  public function getStatusOfClasses($user_id) {
    return $this->get('get_status_of_classes', array('user_id' => $user_id));
  }

  /**
   * Get classes enrolled by.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   Array of info about the courses enrolled in by the specified user.
   */
  public function getClassesEnrolledBy($user_id) {
    return $this->get('get_classes_enrolled_by', ['user_id' => $user_id]);
  }

}
