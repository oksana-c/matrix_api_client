<?php

/**
 * @file
 * Matrix News Feeds Api.
 */

/**
 * Matrix News Feeds Api.
 */
class MatrixNewsFeedsApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * Post the announcement to the class with the specified ID.
   *
   * When posting an announcement, the following options are available:
   * sticky - If true, make the announcement sticky. False by default.
   * notify - If true, send a notification as well. False by default.
   * submitter_id - If set, post as the user with the specified ID,
   * otherwise post as the invoker of the API..
   *
   * @param string $class_id
   *   Class Id.
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   */
  public function postClassAnnouncement($class_id, $message, array $options = []) {
    return $this->get('post_class_announcement', [
      'class_id' => $class_id,
      'message' => $message,
      'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL,
      'notify' => isset($options['notify']) ? $options['notify'] : NULL,
      'sticky' => isset($options['sticky']) ? $options['sticky'] : NULL,
    ]);
  }

  /**
   * Post the message to the class with the specified ID.
   *
   * When posting a message, the following options are available:
   * sticky - If true, make the announcement sticky. False by default.
   * (not available for post_site_message).
   * submitter_id - If set, post as the user with the specified ID,
   * otherwise post as the invoker of the API.
   *
   * @param string $class_id
   *   Class Id.
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   */
  public function postClassMessage($class_id, $message, array $options = []) {
    return $this->get('post_class_message', [
      'class_id' => $class_id,
      'message' => $message,
      'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL,
      'sticky' => isset($options['sticky']) ? $options['sticky'] : NULL,
    ]);
  }

  /**
   * Post the announcement to the group with the specified ID.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   *
   * @see postClassAnnouncement()
   */
  public function postGroupAnnouncement($group_id, $message, array $options = []) {
    return $this->get('post_group_announcement', [
      'group_id' => $group_id,
      'message' => $message,
      'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL,
      'notify' => isset($options['notify']) ? $options['notify'] : NULL,
      'sticky' => isset($options['sticky']) ? $options['sticky'] : NULL,
    ]);
  }

  /**
   * Post the message to the group with the specified ID.
   *
   * @param string $group_id
   *   Group Id.
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   *
   * @see postClassMessage()
   */
  public function postGroupMessage($group_id, $message, array $options = []) {
    return $this->get('post_group_message', [
      'group_id' => $group_id,
      'message' => $message,
      'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL,
      'sticky' => isset($options['sticky']) ? $options['sticky'] : NULL,
    ]);
  }

  /**
   * Post the announcement to the site.
   *
   * The following additional options are available when posting to the site:
   * students - If true, send the announcement to all students. False by
   * default.
   * teachers - If true, send the announcement to all teachers. False by
   * default.
   * parents - If true, send the announcement to all parents. False by default.
   * managers - If true, send the announcement to all managers. False by
   * default.
   *
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   */
  public function postSiteAnnouncement($message, array $options = []) {
    $students = isset($options['students']) ? $options['students'] : NULL;
    $teachers = isset($options['teachers']) ? $options['teachers'] : NULL;
    $managers = isset($options['managers']) ? $options['managers'] : NULL;
    $parents = isset($options['parents']) ? $options['parents'] : NULL;

    return $this->get('post_site_announcement', [
      'message' => $message,
      'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL,
      'notify' => isset($options['notify']) ? $options['notify'] : NULL,
      'sticky' => isset($options['sticky']) ? $options['sticky'] : NULL,
      'students' => $students ,
      'teachers' => $teachers,
      'managers' => $managers,
      'parents' => $parents,
    ]);
  }

  /**
   * Post the message to the site.
   *
   * @param string $message
   *   Message.
   * @param array $options
   *   Array of options.
   *
   * @return mixed
   *   Response.
   *
   * @see postSiteAnnouncement()
   */
  public function postSiteMessage($message, array $options = []) {
    return $this->get('post_site_message', ['message' => $message, 'submitter_id' => isset($options['submitter_id']) ? $options['submitter_id'] : NULL]);
  }

}
