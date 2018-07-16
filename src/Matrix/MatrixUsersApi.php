<?php

/**
 * @file
 * Matrix Users Api.
 */

/**
 * Matrix Users Api.
 *
 * Provides APIs for:
 * - Users,
 * - Sessions.
 */
class MatrixUsersApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Check authentication.
   *
   * Return true if the password is correct for the specified userid,
   * otherwise return false.
   *
   * @param string $userid
   *   User ID (similar to username in other systems).
   * @param string $password
   *   User password.
   *
   * @return bool
   *   Return true if the password is correct for the specified userid,
   *   otherwise return false.
   */
  public function isAuthenticated($userid, $password) {
    return $this->get('is_authenticated', [$userid, $password]);
  }

  /**
   * Get info about the caller's account.
   *
   * @return mixed
   *   Info about caller's account.
   */
  public function getMyAccount() {
    return $this->get('get_my_account');
  }

  /**
   * Get info about all users within caller's school.
   *
   * @param int $page
   *   Page number for paginated results.
   *
   * @return mixed
   *   Array of info about all the users in the caller's school.
   *   This function is paginated.
   */
  public function getAllUsers($page) {
    return $this->get('get_all_users', ['page' => $page]);
  }

  /**
   * Get info for specified users.
   *
   * @param array $user_ids
   *   Array of User IDs.
   *
   * @return array
   *   Array of info about the specified users.
   */
  public function getUsersWithIds(array $user_ids) {
    return $this->get('get_users_with_ids', ['user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Get Users that match.
   *
   * Returns an array of info about the users that satisfy all the specified
   * constraints, which are specified in the form
   * attribute1=value1&attribute2=value2. This function is paginated.
   *
   * User info has the following fields:
   * id - Unique user ID, referred to as user_id when passed as a parameter
   * to an API call.
   * first_name - First name.
   * last_name - Last name.
   * userid - Login userid.
   * password - Login password.
   * email - Email address.
   * sms_email - SMS gateway address.
   * student - True if a student, otherwise false.
   * teacher - True if an instructor, otherwise false.
   * assistant - True if a teaching assistant, otherwise false.
   * administrator - True if an administrator, otherwise false.
   * monitor - True if a monitor, otherwise false.
   * manager - True if a manager, otherwise false.
   * parent - True if a parent, otherwise false (only present if families
   * are enabled).
   * parent_ids - If user has parents, an array of ids of the parent
   * (only present if families are enabled).
   * children_ids - If user has children, an array of ids of the children
   * (only present if families are enabled).
   * year_of_graduation - Year of graduation.
   * student_id - Student ID.
   * teacher_id - Teacher ID.
   * organization_id - If organizations are enabled, the ID of the user's org.
   * organization_id - Organization ID.
   * birthdate - Birthdate.
   * nick_name - Nick name.
   * skype - Skype name.
   * phone - Phone number.
   * gender - If known, Male or Female, otherwise NULL.
   * street_1 - Street address line 1.
   * street_2 - Street address line 2.
   * city - City.
   * state - State/Province.
   * zip - Zip code.
   * country - Country.
   * picture - URL of user profile picture.
   * joined_at - Time account was created.
   * first_login_at - Time of first login.
   * last_login_at - Time of last login.
   * logins - Number of logins.
   * archived - True is the user is archived, otherwise false
   * archived_at -If the user was archived, the time that the archive occurred.
   *
   * The user info also includes entries for any custom fields that are defined.
   *
   * @param array $constraints
   *   Constraints specified in the form attribute1=value1&attribute2=value2.
   * @param int $page
   *   Page number for paginated results.
   *
   * @return mixed
   *   Array of info about the users that satisfy all the specified constraints.
   */
  public function getUsersThatMatch(array $constraints, $page = 1) {
    return $this->get('get_users_that_match', array_merge($constraints, ['page' => $page]));
  }

  /**
   * Add User.
   *
   * Add a user with the specified attributes, which are in the form
   * attribute1=value1&attribute2=value2, etc. If an account with a matching
   * userid, student ID, teacher ID, or name & birth date is found, it's
   * assumed that its information is to be updated instead of creating
   * a new account. Below is a list of special attributes that control
   * how the user is added.
   *
   * When adding a user, the following attributes have a special meaning:
   * account_types - A comma-separated list of account types that the user can
   * have: student, teacher, assistant, manager, monitor, administrator,
   * and/or partial_administrator.
   *
   * change_password - Set to true if you need the user to change their
   * password when they first log in. False by default.
   * update_password - Set to true if you want the password of an existing
   * account to be updated. False by default.
   * send_login_instructions - Set to true if you want the user to be sent login
   * instructions. False by default.
   * from_name - If send_login_instructions is true, send the instructions
   * from this name.
   *
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2.
   *
   * @return string
   *   Returns the userid of the newly added account.
   */
  public function addUser($attributes) {
    return $this->get('add_user', $attributes);
  }

  /**
   * Archive the students with the specified user IDs.
   *
   * @param string $user_ids
   *   User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function archiveStudents($user_ids) {
    return $this->get('archive_students', ['user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Reactivate the students with the specified user IDs.
   *
   * @param string $user_ids
   *   User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function reactivateStudents($user_ids) {
    return $this->get('reactivate_students', ['user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * LMS Sessions.
   *
   * Session info has the following fields:
   * id - User ID
   * count - Number of sessions for this user.
   * sessions - Array of session info, ordered by ascending login_at time.
   * login_at - Time of login.
   * logout_at - Time of logout (can be null if no corresponding
   * logout occurred)
   * ip_address - IP address of login.
   */

  /**
   * Get session details.
   *
   * @param string $user_ids
   *   User Ids separated by commas.
   *
   * @return mixed
   *   Array of detailed info about the sessions for the specified users.
   *   We currently only provide details of sessions that occurred in the
   *   last 30 days.
   */
  public function getSessionDetails($user_ids) {
    return $this->get('get_session_details', ['user_ids' => $this->toArray($user_ids)]);
  }

}
