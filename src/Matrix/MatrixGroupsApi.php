<?php

/**
 * @file
 * Matrix Groups Api.
 */

/**
 * Matrix Groups Api.
 */
class MatrixGroupsApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Get all groups.
   *
   * @param int $page
   *   Page number.
   *
   * @return array
   *   Array of info about all the groups in the caller's business.
   */
  public function getAllGroups($page) {
    return $this->get('get_all_groups', ['page' => $page]);
  }

  /**
   * Get groups with Ids.
   *
   * @param array $group_ids
   *   Group Ids.
   *
   * @return mixed
   *   Array of info about all the specified groups.
   */
  public function getGroupsWithIds(array $group_ids) {
    return $this->get('get_groups_with_ids', ['group_ids' => $this->toArray($group_ids)]);
  }

  /**
   * Get groups that match.
   *
   * @param array $constraints
   *   Constraints in the form [attribute1=>value1, attribute2=>value2].
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about the groups that satisfy all the specified
   *   constraints.
   */
  public function getGroupsThatMatch(array $constraints, $page = 1) {
    return $this->get('get_groups_that_match', array_merge($constraints, ['page' => $page]));
  }

  /**
   * Add group with attributes.
   *
   * When adding a group, the following attributes can be specified:
   * name - The name of the group.
   * description - A description of the group.
   * admin_id - The user ID of the administrator of the group.
   * The caller of the API by default.
   * private - Set to true if you want the group to be private and have an
   * access code. True by default.
   * type - 'Interest', 'Study', 'Club', 'Hobby', 'Faculty', 'Students',
   * or 'Topic'.
   * top_tab - The landing page of the group, which can be 'News', or 'Custom'.
   * 'News' by default.
   * picture - The URL where the picture for the group should be loaded.
   * If omitted, the default group picture is used.
   * tabs - A comma-separate list of the tabs this group should have. The
   * available tabs are 'news', 'custom', 'calendar', 'blog', 'resources',
   * 'forums', 'wikis', 'chat', 'members_tab', and 'admins_tab'.
   *
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2.
   *
   * @return int
   *   Returns the ID of the newly added group.
   */
  public function addGroup($attributes) {
    return $this->get('add_group', $attributes);
  }

  /**
   * Edit the specified group, with the attributes to update.
   *
   * @param string $group_id
   *   Group Id.
   * @param array $attributes
   *   Attributes to update in the form of an key value array
   *   [attribute1=>value1, attribute2=>value2].
   *
   * @return int
   *   Returns the ID of the edited group.
   *
   * @see addGroup()
   */
  public function editGroup($group_id, array $attributes) {
    return $this->get('edit_group', array_merge($attributes, ['group_id' => $group_id]));
  }

  /**
   * Delete the groups with the specified group IDs.
   *
   * @param array $group_ids
   *   Array of group Ids.
   *
   * @return mixed
   *   Response.
   */
  public function deleteGroups(array $group_ids) {
    return $this->get('delete_groups', ['group_ids' => $group_ids]);
  }

  /**
   * LMS Group Members.
   */

  /**
   * Get members for group.
   *
   * @param string $group_id
   *   Group Id.
   *
   * @return array
   *   Return array of group user info for the members.
   */
  public function getMembersForGroup($group_id) {
    return $this->get('get_members_for_group', ['group_id' => $group_id]);
  }

  /**
   * Add the users with the specified IDs as members of the group.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $user_ids
   *   Array of User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function addMembersToGroup($group_id, $user_ids) {
    return $this->get('add_members_to_group', ['group_id' => $group_id, 'user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Remove the users with the specified IDs from the group.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $user_ids
   *   Array of User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function removeMembersFromGroup($group_id, $user_ids) {
    return $this->get('remove_members_from_group', ['group_id' => $group_id, 'user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Get groups with member.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   Return array of info about all the groups that the specified user id
   *   a member of.
   */
  public function getGroupsWithMember($user_id) {
    return $this->get('get_groups_with_member', ['user_id' => $user_id]);
  }

  /**
   * LMS Group Admins.
   */

  /**
   * Get admins for group.
   *
   * @param string $group_id
   *   Group Id.
   *
   * @return mixed
   *   Return array of group user info for the admins.
   */
  public function getAdminsForGroup($group_id) {
    return $this->get('get_admins_for_group', ['group_id' => $group_id]);
  }

  /**
   * Add the users with the specified IDs as admins of the group.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $user_ids
   *   Array of User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function addAdminsToGroup($group_id, $user_ids) {
    return $this->get('add_admins_to_group', ['group_id' => $group_id, 'user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Remove the users with the specified IDs as admins of the group.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $user_ids
   *   Array of User Ids.
   *
   * @return mixed
   *   Response.
   */
  public function removeAdminsFromGroup($group_id, $user_ids) {
    return $this->get('remove_admins_from_group', ['group_id' => $group_id, 'user_ids' => $this->toArray($user_ids)]);
  }

  /**
   * Get groups with admin.
   *
   * @param string $user_id
   *   User Id.
   *
   * @return mixed
   *   An array of info about all the groups that the specified user
   *   id an admin of.
   */
  public function getGroupsWithAdmin($user_id) {
    return $this->get('get_groups_with_admin', ['user_id' => $user_id]);
  }

}
