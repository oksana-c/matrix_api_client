<?php

/**
 * @file
 * Matrix Classes Api.
 */

/**
 * Matrix Classes Api.
 *
 * Includes API for:
 * - Classes
 * - Templates.
 */
class MatrixClassesApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * LMS Classes.
   *
   * Class info has the following fields:
   * id - Unique class ID, referred to as class_id when passed as a parameter
   * to an API call.
   * name - Name.
   * style - The style ('Instructor', 'Self paced' or 'Blended').
   * course_code - Course code.
   * section_code - Section code.
   * picture - URL of the class's picture.
   * semester - Semester.
   * start - Start date of the class (if not self paced).
   * finish - Finish date of the class (if not self paced).
   * weighting_using_categories - True if group assignments by category when
   * calculating weights.
   * weighting_style - Weighting style ('MaxScore', 'Points', 'Percent',
   * 'Equally').
   * display_in_catalog - True if the course is displayed in the catalog,
   * otherwise false.
   * archived - True if the course is archived.
   * catalog_category - The catalog categories of the course.
   * grademap - Array of grade mappings of the form {'grade' => grade,
   * 'minimum_percent' => percent} in descending order of minimum percent.
   * grading_periods - Array of grading periods of the form {'name' => name,
   * 'percent' => percent, 'start' => start} in ascending order of start date.
   */

  /**
   * Get all classes.
   *
   * This function is paginated.
   *
   * @param int $page
   *   Page number.
   *
   * @return array
   *   Array of info about all the courses in the caller's school.
   */
  public function getAllClasses($page) {
    return $this->get('get_all_classes', ['page' => $page]);
  }

  /**
   * Get classes w/ Ids.
   *
   * @param string $class_ids
   *   Class Ids separated by commas.
   *
   * @return array
   *   Array of info about all the specified courses.
   */
  public function getClassesWithIds($class_ids) {
    return $this->get('get_classes_with_ids', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Get classes that match constraints.
   *
   * The supported attributes are name, course_code, section_code, and archived.
   * This function is paginated.
   *
   * @param array $constraints
   *   Array of constraints in the form attribute1=value1&attribute2=value2.
   * @param int $page
   *   Page number.
   *
   * @return array
   *   Array of info about the courses that satisfy all the specified
   *   constraints.
   */
  public function getClassesThatMatch(array $constraints, $page = 1) {
    return $this->get('get_classes_that_match', array_merge($constraints, ['page' => $page]));
  }

  /**
   * Get classes for organization.
   *
   * This function is paginated.
   *
   * @param string $organization_id
   *   Organization Id.
   * @param int $page
   *   Page number.
   *
   * @return array
   *   Array of info about all the courses that have at least one student
   *   enrolled from the specified organization.
   */
  public function getClassesForOrganization($organization_id, $page = 1) {
    return $this->get('get_classes_for_organization', ['organization_id' => $organization_id, 'page' => $page]);
  }

  /**
   * Add a class.
   *
   * When adding a course, the following attributes can be specified:
   * name - The name of the course.
   * description - A description of the course.
   * style - The style of the course, which can be 'Instructor', 'Self paced',
   * or 'Blended'. 'Self-paced' by default.
   * start_at - If instructor-led or blended, the start date of the course.
   * finish_at - If instructor-led or blended, the end date of the course.
   * private - Set to true if you want the course to be private and have an
   * access code. True by default.
   * top_tab - The landing page of the course, which can be 'News', 'Lessons',
   * 'Custom', 'CurrentLesson', or 'Agenda'. 'Lessons' by default.
   * picture - The URL where the picture for the course should be loaded.
   * If omitted, the default course picture is used.
   * tabs - A comma-separate list of the tabs this class should have.
   * The available tabs are 'custom', 'news', 'lessons', 'custom', 'calendar',
   * 'blogs', 'resources', 'forums', 'wikis', 'chat', 'attendance', 'groups',
   * 'portfolios', 'reviews', 'syllabus_tab', 'students_tab', 'parents_tab',
   * and 'teachers_tab'.
   *
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2.
   *
   * @return mixed
   *   The ID of the newly added course.
   */
  public function addClass($attributes) {
    return $this->get('add_class', $attributes);
  }

  /**
   * Add a class from template.
   *
   * Add a course which is a copy of the specified course template, then set
   * the specified attributes (which are optional) on the copy.
   *
   * @param string $class_template_id
   *   The template Id.
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2.
   *
   * @return mixed
   *   The ID of the newly added course.
   */
  public function addClassFromTemplate($class_template_id, $attributes) {
    return $this->get('add_class_from_template', array_merge($attributes, ['class_template_id' => $class_template_id]));
  }

  /**
   * Add child class.
   *
   * Add a child course to the specified parent course, then set the specified
   * attributes (which are optional) on the copy.
   *
   * @param string $parent_class_id
   *   The parent class id.
   * @param array $attributes
   *   The attributes in the form
   *   [attribute1=>value1, attribute2=>value2].
   *
   * @return mixed
   *   The ID of the newly added child course.
   */
  public function addChildClass($parent_class_id, array $attributes) {
    return $this->get('add_child_class', array_merge($attributes, ['parent_class_id' => $parent_class_id]));
  }

  /**
   * Edit specified class.
   *
   * @param string $class_id
   *   Class Id.
   * @param array $attributes
   *   The attributes to update in the form
   *   [attribute1=>value1, attribute2=>value2]. The attributes are
   *   the same as the attributes for add_class().
   *
   * @return mixed
   *   The ID of the edited course.
   */
  public function editClass($class_id, array $attributes) {
    return $this->get('edit_class', array_merge($attributes, ['class_id' => $class_id]));
  }

  /**
   * Archive the specified classes.
   *
   * @param string $class_ids
   *   Class Ids.
   *
   * @return mixed
   *   Ids of archived classes.
   */
  public function archiveClasses($class_ids) {
    return $this->get('archive_classes', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Unarchive the specified classes.
   *
   * @param string $class_ids
   *   Class Ids.
   *
   * @return mixed
   *   Ids of reactivated classes.
   */
  public function reactivateClasses($class_ids) {
    return $this->get('reactivate_classes', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Delete the specified classes (and place them into the trash can).
   *
   * @param string $class_ids
   *   Class Ids.
   *
   * @return mixed
   *   Ids of deleted classes.
   */
  public function deleteClasses($class_ids) {
    return $this->get('delete_classes', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Restore the specified classes from the trash can.
   *
   * @param string $class_ids
   *   Class Ids.
   *
   * @return mixed
   *   Ids of restored classes.
   */
  public function restoreClasses($class_ids) {
    return $this->get('restore_classes', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * LMS Templates.
   */

  /**
   * Get all class templates.
   *
   * This function is paginated.
   *
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about all the courses in the caller's school.
   */
  public function getAllClassTemplates($page) {
    return $this->get('get_all_class_templates', ['page' => $page]);
  }

  /**
   * Get all class templates with Ids.
   *
   * @param array $class_ids
   *   Class Ids.
   *
   * @return mixed
   *   Array of info about all the specified courses.
   */
  public function getClassTemplatesWithIds(array $class_ids) {
    return $this->get('get_class_templates_with_ids', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Get class templates that match constraints.
   *
   * @param string $constraints
   *   Constraints in the form attribute1=value1&attribute2=value2.
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about the courses that satisfy all the specified
   *   constraints.
   */
  public function getClassTemplatesThatMatch($constraints, $page = 1) {
    return $this->get('get_class_templates_that_match', array_merge($constraints, ['page' => $page]));
  }

  /**
   * Get class templates that match constraints.
   *
   * This function is paginated.
   *
   * @param string $organization_id
   *   Organization Id.
   * @param int $page
   *   Page number.
   *
   * @return mixed
   *   Array of info about all the courses that have at least one student
   *   enrolled from the specified organization.
   */
  public function getClassTemplatesForOrganization($organization_id, $page = 1) {
    return $this->get('get_class_templates_for_organization', ['organization_id' => $organization_id, 'page' => $page]);
  }

  /**
   * Add class template.
   *
   * @param string $attributes
   *   Attributes in the form attribute1=value1&attribute2=value2, etc.
   *
   * @return string
   *   Returns the ID of the newly added course.
   */
  public function addClassTemplate($attributes) {
    return $this->get('add_class_template', $attributes);
  }

  /**
   * Edit specified class template.
   *
   * @param string $class_id
   *   Class Id.
   * @param array $attributes
   *   Attributes to update in the form of key value array
   *   [attribute1=>value1, attribute2=>value2].
   *   The attributes are the same as the attributes for add_class().
   *
   * @return string
   *   Returns the ID of the edited course template.
   */
  public function editClassTemplate($class_id, array $attributes) {
    return $this->get('edit_class_template', array_merge($attributes, ['class_id' => $class_id]));
  }

  /**
   * Delete the specified class templates (and place them into the trash can).
   *
   * @param array $class_ids
   *   Class Ids.
   *
   * @return string
   *   Response.
   */
  public function deleteClassTemplates(array $class_ids) {
    return $this->get('delete_class_templates', ['class_ids' => $this->toArray($class_ids)]);
  }

  /**
   * Restore the specified class templates from the trash can.
   *
   * @param string $class_ids
   *   Class Ids separated by commas.
   *
   * @return string
   *   Response.
   */
  public function restoreClassTemplates($class_ids) {
    return $this->get('restore_class_templates', ['class_ids' => $this->toArray($class_ids)]);
  }

}
