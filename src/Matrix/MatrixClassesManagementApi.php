<?php

/**
 * @file
 * Matrix Classes Management Api.
 */

/**
 * Matrix Classes Management Api.
 *
 * Includes API for:
 * - Paths
 * - Lessons
 * - Mastery
 * - Attendance
 * - Grades
 * - Resources
 * - Curricula
 * - Reports.
 */
class MatrixClassesManagementApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * LMS Paths.
   */

  /**
   * Get all paths.
   *
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about all the paths in the caller's school.
   */
  public function getAllPaths($page) {
    return $this->get('get_all_paths', ['page' => $page]);
  }

  /**
   * Get paths with Ids.
   *
   * @param string $path_ids
   *   Path Ids separated by commas.
   *
   * @return mixed
   *   Array of info about all the specified paths.
   */
  public function getPathsWithIds($path_ids) {
    return $this->get('get_paths_with_ids', ['path_ids' => $this->toArray($path_ids)]);
  }

  /**
   * Get admins for path.
   *
   * @param string $path_id
   *   Path Id.
   *
   * @return mixed
   *   Array of info about admins for the path.
   */
  public function getAdminsForPath($path_id) {
    return $this->get('get_admins_for_path', ['path_id' => $path_id]);
  }

  /**
   * Get students for path.
   *
   * @param string $path_id
   *   Path Id.
   *
   * @return mixed
   *   Array of user info about the students in the specified path.
   */
  public function getStudentsForPath($path_id) {
    return $this->get('get_students_for_path', ['path_id' => $path_id]);
  }

  /**
   * Enroll the specified users into the specified path.
   *
   * @param string $path_id
   *   Path Id.
   * @param array $user_ids
   *   Array of user Ids.
   *
   * @return mixed
   *   If successful, the number of users that were enrolled is returned.
   *   This API either succeeds completely or fails completely - if an errors
   *   occur, no users are enrolled.
   */
  public function addStudentsToPath($path_id, array $user_ids) {
    return $this->get('add_students_to_path', ['path_id' => $path_id, 'user_ids' => $user_ids]);
  }

  /**
   * Unenroll the specified users from the specified path.
   *
   * @param string $path_id
   *   Path Id.
   * @param array $user_ids
   *   Array of user Ids.
   *
   * @return mixed
   *   If successful, the number of users that were unenrolled is returned.
   */
  public function removeStudentsFromPath($path_id, array $user_ids) {
    return $this->get('remove_students_from_path', ['path_id' => $path_id, 'user_ids' => $user_ids]);
  }

  /**
   * LMS Lessons.
   */

  /**
   * Get lessons for class.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of info about all the lessons in the specified class, in the
   *   order that they appear.
   */
  public function getLessonsForClass($class_id) {
    return $this->get('get_lessons_for_class', ['class_id' => $class_id]);
  }

  /**
   * LMS Assignments.
   */

  /**
   * Get assignments for class.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of info about all the assignments in the specified course,
   *   in the order that they appear.
   */
  public function getAssignmentsForClass($class_id) {
    return $this->get('get_assignments_for_class', ['class_id' => $class_id]);
  }

  /**
   * LMS Mastery.
   */

  /**
   * Get Mastery for class.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Mastery data in the form {'proficiencies' => [proficiency info],
   *   'students' => [student info]}
   */
  public function getMasteryForClass($class_id) {
    return $this->get('get_mastery_for_class', ['class_id' => $class_id]);
  }

  /**
   * LMS Attendance.
   */

  /**
   * Get all attendance.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of all the attendance data for the specified course.
   */
  public function getAllAttendance($class_id) {
    return $this->get('get_all_attendance', ['class_id' => $class_id]);
  }

  /**
   * Get attendance for class and date/time.
   *
   * @param string $class_id
   *   Class Id.
   * @param string $date_and_time
   *   Date / time in a form of timestamp.
   *
   * @return mixed
   *   The attendance data for the specified course at the specific date/time.
   */
  public function getAttendance($class_id, $date_and_time) {
    return $this->get('get_attendance', ['class_id' => $class_id, 'date_and_time' => $date_and_time]);
  }

  /**
   * LMS Grades.
   */

  /**
   * Get grades for class.
   *
   * @param string $class_id
   *   Class Id.
   *
   * @return mixed
   *   Array of grade info for each user in the specified class.
   */
  public function getGradesForClass($class_id) {
    return $this->get('get_grades_for_class', ['class_id' => $class_id]);
  }

  /**
   * Get grades for user.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   Array of the form {'class_id' => class_id, 'grades' => <grade info>}
   *   for the specified user in all their classes (excluding those that are
   *   archived).
   */
  public function getGradesForUser($user_id) {
    return $this->get('get_grades_for_user', ['user_id' => $user_id]);
  }

  /**
   * Set the grades for the specified users within the specified assignment.
   *
   * @param string $assignment_id
   *   Assignment Id.
   * @param array $grades
   *   The grades are an array of the form {'user_id' => user_id,
   *   'grade' => grade}. A grade can be a letter grade (B+), a floating point
   *   number (3.1), a percentage (15%), a blank ('') or a special grade
   *   (X/M/I/AB).
   *
   * @return mixed
   *   Response.
   */
  public function setGradesForAssignment($assignment_id, array $grades) {
    $args = [];

    foreach ($grades as $grade) {
      array_push($args, json_encode(['user_id' => $grade['user_id'], 'grade' => urlencode($grade['grade'])]));
    }
    return $this->get('set_grades_for_assignment', array_merge(['assignment_id' => $assignment_id], ['grades' => $args]));
  }

  /**
   * LMS Resources.
   *
   * Resource info has the following fields:
   * id - Resource ID
   * type - The type of resource (Assignment, Badge, Certificate,
   * Class template, Competencies, Equalla, File, Google doc, Lesson, Page,
   * Question bank, Rubric, SCORM package, Tool, Tool provider, Web resource).
   * name - Name of resource.
   * library - The library where the resource is located (Personal,
   * Organization, School, Network, All).
   * creator_id - The user ID of the resource creator.
   * created_at - When the resource was created.
   * url - The URL of the page that shows this resource on the LMS.
   * subject - The subject of the resource (if K-20 subjects are enabled).
   */

  /**
   * Get resource information.
   *
   * @param array $constraints
   *   The constraints are specified in the form
   *   [attribute1=>value1, attribute2=>value2].
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about the resources (resources) that satisfy all the
   *   specified constraints and the total number of matches (count).
   */
  public function getResources(array $constraints, $page = 1) {
    return $this->get('get_resources', array_merge($constraints, ['page' => $page]));
  }

  /**
   * LMS Curricula.
   */

  /**
   * Get all curricula.
   *
   * @return mixed
   *   Array of info about all competencies.
   */
  public function getAllCurricula() {
    return $this->get('get_all_curricula');
  }

  /**
   * Get curricula with Ids.
   *
   * @param string $curriculum_ids
   *   Curricula ids separated by commas.
   *
   * @return mixed
   *   Array of info about the competencies with the specified ids.
   */
  public function getCurriculaWithIds($curriculum_ids) {
    return $this->get('get_curricula_with_ids', ['curriculum_ids' => $this->toArray($curriculum_ids)]);
  }

  /**
   * Get proficiencies for curriculum.
   *
   * @param string $curriculum_id
   *   Curriculum Id.
   *
   * @return mixed
   *   Array of info about the competecies in the specified competencies with
   *   sub-competencies included as children of their parent competency.
   */
  public function getProficienciesForCurriculum($curriculum_id) {
    return $this->get('get_proficiencies_for_curriculum', ['curriculum_id' => $curriculum_id]);
  }

  /**
   * LMS Reports.
   *
   * Course report info has the following fields:
   * student_id - The unique ID of the student.
   * enrolled_at - When they were enrolled.
   * started_at - When they first visited the course.
   * last_visited_at - When they last visited the course.
   * completed_at - When they completed the course.
   * score - Their final score in the form {percent: <percentage>, grade:
   * <grade letter>}.
   */

  /**
   * Get class report.
   *
   * The following constraints are currently supported:
   * student_ids - Select the students whose id is in the specified array of
   * ids. If this constraint is omitted, all currently active students are
   * selected.
   * from - Only select students that are not currently deactivated or were
   * not deactivated before the specified time.
   * to - Only select students who were enrolled before the specified time.
   *
   * @param string $class_id
   *   Class Id.
   * @param array $constraints
   *   If you supply optional constraints in the form [attribute1=>value1,
   *   attribute2=value2], only students that satisfy all the constraints
   *   are considered.
   *
   * @return mixed
   *   Array of info about the students in the specified course.
   */
  public function getClassReport($class_id, array $constraints) {
    return $this->get('get_class_report', array_merge(['class_id' => $class_id], $constraints));
  }

}
