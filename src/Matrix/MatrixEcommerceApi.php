<?php

/**
 * @file
 * Matrix Ecommerce Api.
 */

/**
 * Matrix Ecommerce Api.
 */
class MatrixEcommerceApi extends MatrixApi {

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    parent::__construct(...func_get_args());
  }

  /**
   * LMS E-commerce.
   *
   * Order info has the following fields:
   * id - Unique order ID.
   * user_id - User ID of purchaser.
   * user_name - Name of purchaser.
   * organization_id - Organization ID of purchaser.
   * checkout_at - Time of purchase.
   * currency - Currency of purchase.
   * bulk_discount - Amount of bulk discount, if any.
   * coupon_codes - Coupon codes associated with the order, if any.
   * items - Array of item info for each item in the order.
   *
   * Item info has the following fields:
   * id - Unique ID of item in order.
   * quantity - Quantity of item.
   * unit_cost - Unit code of item.
   * used - Quantity of item used so far.
   * item_id - ID of item (such as ID of course, digital media, etc.).
   * item_type - Type of item (such as Class, DigitalMedia, Bundle,
   * Subscription, etc.).
   * item_name - Name of item.
   * discount_type - Type of discount, if any.
   * discount - Amount of discount, if any.
   * coupon_id - ID of coupon applied, if any.
   * items - If the item is a Bundle, an array of info about the items in
   * the bundle.
   */

  /**
   * Get all orders.
   *
   * This function is paginated.
   *
   * @return array
   *   Array of info for all orders.
   */
  public function getAllOrders() {
    return $this->get('get_all_orders');
  }

  /**
   * Get all orders with Ids.
   *
   * This function is paginated.
   *
   * @param string $order_ids
   *   Order Ids separated by commas.
   *
   * @return array
   *   Array of info for orders with the specified ids.
   */
  public function getOrdersWithIds($order_ids) {
    return $this->get('get_orders_with_ids', ['order_ids' => $this->toArray($order_ids)]);
  }

  /**
   * Get info for all orders purchased by members of an organization.
   *
   * This function is paginated.
   *
   * @param array $organization_id
   *   Organization Id.
   *
   * @return array
   *   Array of info for all orders purchased by members of the specified
   *   organization.
   */
  public function getOrdersForOrganization(array $organization_id) {
    return $this->get('get_orders_for_organization', array('organization_id' => $organization_id));
  }

  /**
   * Get info for all orders purchased by specified user.
   *
   * This function is paginated.
   *
   * @param array $user_id
   *   User Id.
   *
   * @return array
   *   Array of info for all orders purchased by the specified user.
   */
  public function getOrdersForUser(array $user_id) {
    return $this->get('get_orders_for_user', ['user_id' => $user_id]);
  }

}
