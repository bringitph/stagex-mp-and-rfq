<?php

/**
 * Seller table template
 */

namespace wooMarketplaceRFQ\Templates\Front\Seller;

use DateTime;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Womprfq_Seller_Table_Template' ) ) {

	/**
	 * Class seller table data
	 */
	class Womprfq_Seller_Table_Template {

		protected $tab;
		protected $page;
		protected $limit;
		protected $total_count;

		public function __construct( $data, $tab, $page, $limit, $total_count ) {
			$this->tab         = $tab;
			$this->page        = $page;
			$this->limit       = $limit;
			$this->total_count = $total_count;
			$this->womprfq_prepare_seller_table_template( $data );
		}

		/**
		 * Returns seller list table
		 *
		 * @param array $data data array
		 *
		 * @return void
		 */
		public function womprfq_prepare_seller_table_template( $data ) {
				global $wkmarketplace;
			$format    = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
			$page_name = $wkmarketplace->seller_page_slug ? $wkmarketplace->seller_page_slug : get_query_var( 'pagename' );
			?>
			<table id="manage-quote" class="transactionhistory">
				<thead>
					<tr>
						<!--JS edit: On Seller side, change Quotation ID header to Request ID-->
                        <th width="10%"><?php esc_html_e( 'Request', 'wk-mp-rfq' ); ?></th>
						<th width="25%"><?php esc_html_e( 'Product Name', 'wk-mp-rfq' ); ?></th>
						<th width="15%"><?php esc_html_e( 'Quoted Quantity', 'wk-mp-rfq' ); ?></th>
						<th width="20%"><?php esc_html_e( 'Date Created', 'wk-mp-rfq' ); ?></th>
						<th width="15%"><?php esc_html_e( 'Customer', 'wk-mp-rfq' ); ?></th>
						<th width="15%"><?php esc_html_e( 'Action', 'wk-mp-rfq' ); ?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if ( ! empty( $data['data'] ) ) {
					if ( $data['tab'] == 'open' ) {
						$url_red   = site_url( esc_html( $page_name ) . '/add-quote/' );
						$title_red = esc_html__( 'Add Quotation', 'wk-mp-rfq' );
					} else {
						$url_red = site_url( esc_html( $page_name ) . '/edit-rfq/' );
						if ( $data['tab'] == 'closed' ) {
							$title_red = esc_html__( 'View Quotation', 'wk-mp-rfq' );
						} else {
							$title_red = esc_html__( 'Edit Quotation', 'wk-mp-rfq' );
						}
					}
					foreach ( $data['data'] as $data ) {
						$d = new DateTime( $data['date_created'] );
						?>
						<tr>
							<td>
								<!-- JS edit: Make Request ID hyperlinked in Sellers RFQ list to offer to --> 
								<a class="edit-slots" href="<?php echo esc_url( $url_red . intval( $data['id'] ) ); ?>">
                                <?php echo esc_html( '' . intval( $data['id'] ) ); ?></a>
							</td>
							<td>
								<?php echo esc_html( $data['product_info']['name'] ); ?>
							</td>
							<td>
								<?php echo esc_html( $data['quote_quantity'] ); ?>
							</td>
							<td>
								<?php echo esc_html( $d->format( $format ) ); ?>
							</td>
							<td>
								<?php echo esc_html( ucfirst( $data['customer_info']['display_name'] ) ); ?>
							</td>
							<td>
								<a class="edit-slots" href="<?php echo esc_url( $url_red . intval( $data['id'] ) ); ?>">
									<?php echo esc_html( $title_red ); ?>
								</a>
							</td>
						</tr>
						<?php
					}
				} else {
					?>
						<tr>
							<td colspan="6" class="wkmp-nodata-td" id="wkmp-nodata-td" width="100%"><?php esc_html_e( 'No Data Found', 'wk-mp-rfq' ); ?></td>
						</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<?php
			if ( 1 < $this->total_count ) :
				?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination wallet-pagination" style="margin-top:10px;">
				<?php
				if ( 1 !== $this->page && $this->page > 1 ) :
				
				// JS edit. Add country and city drop down filter and country preference. Step 10
					$seller_country = get_user_meta(get_current_user_id(),'subscribe_country',true);
					if( isset($_GET['c']) ){
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page - 1 ) . '?c=' . esc_html( $_GET['c'] )  ) );
					}elseif(!empty($seller_country) && $seller_country != "all" && $this->tab == "open" ){
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page - 1 ) . '?c=' . esc_html( $seller_country )  ) );
					}else{
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page - 1 ) . '?tab=' . esc_html( $this->tab )  ) );
					}
					
					?>
				
				<!-- JS edit. Add country and city drop down filter and country preference. Step 11 -->
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page - 1 ) . '?tab=' . esc_html( $this->tab ) ) ); ?>">
					<?php esc_html_e( 'Previous', 'wk-mp-rfq' ); ?>
				</a>
				<?php endif; ?>

				<?php
				if ( ceil( $this->total_count / $this->limit ) > $this->page ) :
				
				// JS edit. Add country and city drop down filter and country preference. Step 12
					$seller_country = get_user_meta(get_current_user_id(),'subscribe_country',true);
					if( isset($_GET['c']) ){
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page + 1 ) . '?c=' . esc_html( $_GET['c'] )  ) );
					}elseif(!empty($seller_country) && $seller_country != "all" && $this->tab == "open" ){
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page + 1 ) . '?c=' . esc_html( $seller_country )  ) );
					}else{
						$url = esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page + 1 ) . '?tab=' . esc_html( $this->tab )  ) );
					}
					
					?>
				
				<!-- JS edit. Add country and city drop down filter and country preference. Step 13 -->
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( site_url( esc_html( $page_name ) . '/manage-rfq/' . intval( $this->page + 1 ) . '?tab=' . esc_html( $this->tab ) ) ); ?>">
					<?php echo esc_html_e( 'Next', 'wk-mp-rfq' ); ?>
					</a>
				<?php endif; ?>
		</div>
				<?php
		endif;
		}
	}
}
