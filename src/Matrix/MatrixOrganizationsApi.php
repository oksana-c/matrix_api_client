<?php

/**
 * @file
 * Matrix Organizations Api.
 */

/**
 * Matrix Organizations Api.
 */
class MatrixOrganizationsApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Get all organizations in the caller's business.
   *
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about all the organizations in the caller's business.
   */
  public function getAllOrganizations($page) {
    return $this->get('get_all_organizations', ['page' => $page]);
  }

  /**
   * Get organizations with Ids.
   *
   * @param string $organization_ids
   *   Organization Ids separated by commas.
   *
   * @return mixed
   *   Array of info about all the specified organizations.
   */
  public function getOrganizationsWithIds($organization_ids) {
    return $this->get('get_organizations_with_ids', ['organization_ids' => $this->toArray($organization_ids)]);
  }

  /**
   * Add organization with attributes.
   *
   * When adding an organization, the following attributes can be specified:
   * name - The name of the organization.
   * description - A description of the organization.
   * internal - Set to true if you want the organization to be internal.
   * False by default.
   * picture - The URL where the picture for the organization should be loaded.
   * If omitted, the default organization picture is used.
   *
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2.
   *
   * @return mixed
   *   Returns the ID of the newly added organization.
   */
  public function addOrganization($attributes) {
    return $this->get('edit_organization', $attributes);
  }

  /**
   * Edit the specified organization, with the attributes to update.
   *
   * @param string $organization_id
   *   Organization Id.
   * @param array $attributes
   *   Attributes in the form attribute1=>value1.
   *   The attributes are the same as the attributes for add_organization().
   *
   * @return mixed
   *   Returns the ID of the edited organization.
   *
   * @see addOrganization()
   */
  public function editOrganization($organization_id, array $attributes) {
    return $this->get('edit_organization', array_merge($attributes, ['organization_id' => $organization_id]));
  }

  /**
   * Delete the organizations with the specified organization IDs.
   *
   * @param string $organization_ids
   *   Organization Ids separated by commas.
   *
   * @return mixed
   *   Response.
   */
  public function deleteOrganizations($organization_ids) {
    return $this->get('delete_organizations', ['organization_ids' => $this->toArray($organization_ids)]);
  }

}
