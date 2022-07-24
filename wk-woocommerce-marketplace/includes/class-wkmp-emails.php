<?php
/**
 * Marketplace email class
 *
 * @package Multi Vendor Marketplace
 * @version 5.0.0
 */

namespace WkMarketplace\Includes;

use WkMarketplace\Includes\Emails;

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WKMP_Emails' ) ) {
	/**
	 * Email handler class.
	 *
	 * Class WKMP_Emails
	 *
	 * @package WkMarketplace\Includes
	 */
	class WKMP_Emails {

		/**
		 * Email handler constructor.
		 *
		 * WKMP_Emails constructor.
		 */
		public function __construct() {
			add_filter( 'woocommerce_email_classes', array( $this, 'wkmp_add_new_email_notification' ), 10, 1 );
			add_filter( 'woocommerce_email_actions', array( $this, 'wkmp_add_woocommerce_email_actions' ) );
		}

		/**
		 * Marketplace Email classes.
		 *
		 * @param array $email Email.
		 *
		 * @return array $email
		 */
		public function wkmp_add_new_email_notification( $email ) {

			$email['WC_Email_WKMP_Ask_To_Admin']                     = new Emails\WC_Email_WKMP_Ask_To_Admin();
			$email['WC_Email_WKMP_Seller_Published_Product']         = new Emails\WC_Email_WKMP_Seller_Published_Product();
			$email['WC_Email_WKMP_Seller_Account_Approved']          = new Emails\WC_Email_WKMP_Seller_Account_Approved();
			$email['WC_Email_WKMP_Registration_Details_To_Seller']   = new Emails\WC_Email_WKMP_Registration_Details_To_Seller();
			$email['WC_Email_WKMP_Seller_Account_Disapproved']       = new Emails\WC_Email_WKMP_Seller_Account_Disapproved();
			$email['WC_Email_WKMP_Seller_Query_Replied']             = new Emails\WC_Email_WKMP_Seller_Query_Replied();
			$email['WC_Email_WKMP_Seller_Product_Ordered']           = new Emails\WC_Email_WKMP_Seller_Product_Ordered();
			$email['WC_Email_WKMP_Seller_Order_Failed']              = new Emails\WC_Email_WKMP_Seller_Order_Failed();
			$email['WC_Email_WKMP_Seller_Order_On_Hold']             = new Emails\WC_Email_WKMP_Seller_Order_On_Hold();
			$email['WC_Email_WKMP_Seller_Order_Refunded']            = new Emails\WC_Email_WKMP_Seller_Order_Refunded();
			$email['WC_Email_WKMP_Seller_Order_Completed']           = new Emails\WC_Email_WKMP_Seller_Order_Completed();
			$email['WC_Email_WKMP_Seller_Order_Cancelled']           = new Emails\WC_Email_WKMP_Seller_Order_Cancelled();
			$email['WC_Email_WKMP_Seller_Order_Processing']          = new Emails\WC_Email_WKMP_Seller_Order_Processing();
			$email['WC_Email_WKMP_New_Seller_Registration_To_Admin'] = new Emails\WC_Email_WKMP_New_Seller_Registration_To_Admin();
			$email['WC_Email_WKMP_Product_Approve_Disapprove']       = new Emails\WC_Email_WKMP_Product_Approve_Disapprove();
			$email['WC_Email_WKMP_Seller_To_Shop_Followers']         = new Emails\WC_Email_WKMP_Seller_To_Shop_Followers();
			$email['WC_Email_WKMP_Customer_Become_Seller']           = new Emails\WC_Email_WKMP_Customer_Become_Seller();
			$email['WC_Email_WKMP_Customer_Become_Seller_To_Admin']  = new Emails\WC_Email_WKMP_Customer_Become_Seller_To_Admin();
			$email['WC_Email_WKMP_Seller_Order_Paid']                = new Emails\WC_Email_WKMP_Seller_Order_Paid();

			return $email;
		}

		/**
		 * Marketplace Email action.
		 *
		 * @param array $actions Actions.
		 *
		 * @return array $actions
		 */
		public function wkmp_add_woocommerce_email_actions( $actions ) {
			$actions[] = 'wkmp_ask_to_admin';
			$actions[] = 'wkmp_seller_published_product';
			$actions[] = 'wkmp_product_approve_disapprove';
			$actions[] = 'wkmp_seller_account_approved';
			$actions[] = 'wkmp_seller_account_disapproved';
			$actions[] = 'wkmp_seller_product_ordered';
			$actions[] = 'wkmp_seller_order_cancelled';
			$actions[] = 'wkmp_seller_order_failed';
			$actions[] = 'wkmp_seller_order_on_hold';
			$actions[] = 'wkmp_seller_order_processing';
			$actions[] = 'wkmp_seller_order_completed';
			$actions[] = 'wkmp_seller_order_refunded';
			$actions[] = 'wkmp_seller_order_refunded_completely';
			$actions[] = 'wkmp_seller_query_replied';
			$actions[] = 'wkmp_seller_to_shop_followers';
			$actions[] = 'wkmp_registration_details_to_seller';
			$actions[] = 'wkmp_new_seller_registration_to_admin';
			$actions[] = 'wkmp_customer_become_seller';
			$actions[] = 'wkmp_customer_become_seller_to_admin';
			$actions[] = 'wkmp_seller_order_paid';

			return $actions;
		}
	}
}
