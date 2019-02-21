<?php

if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
	return;

class My_Child_Class extends The_Parent_Class { 



}


add_action( 'plugins_loaded', 'wc_offline_gateway_init', 11 );

function wc_offline_gateway_init() {

    class WC_Gateway_Offline extends WC_Payment_Gateway {

        // The meat and potatoes of our gateway will go here

        public function init_form_fields() {
		      
		    $this->form_fields = apply_filters( 'wc_offline_form_fields', array(
		          
		        'enabled' => array(
		            'title'   => __( 'Enable/Disable', 'wc-gateway-offline' ),
		            'type'    => 'checkbox',
		            'label'   => __( 'Enable Offline Payment', 'wc-gateway-offline' ),
		            'default' => 'yes'
		        ),

		        'title' => array(
		            'title'       => __( 'Title', 'wc-gateway-offline' ),
		            'type'        => 'text',
		            'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'wc-gateway-offline' ),
		            'default'     => __( 'Offline Payment', 'wc-gateway-offline' ),
		            'desc_tip'    => true,
		        ),

		        'description' => array(
		            'title'       => __( 'Description', 'wc-gateway-offline' ),
		            'type'        => 'textarea',
		            'description' => __( 'Payment method description that the customer will see on your checkout.', 'wc-gateway-offline' ),
		            'default'     => __( 'Please remit payment to Store Name upon pickup or delivery.', 'wc-gateway-offline' ),
		            'desc_tip'    => true,
		        ),

		        'instructions' => array(
		            'title'       => __( 'Instructions', 'wc-gateway-offline' ),
		            'type'        => 'textarea',
		            'description' => __( 'Instructions that will be added to the thank you page and emails.', 'wc-gateway-offline' ),
		            'default'     => '',
		            'desc_tip'    => true,
		        ),
		    ) );
		}

    } // end \WC_Gateway_Offline class
}