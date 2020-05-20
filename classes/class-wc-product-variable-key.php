<?php
if ( ! class_exists( 'WC_Product_Variable_Key' ) ) {
    class WC_Product_Variable_Key extends WC_Product_Variable {

        public function __construct( $product = 0 ) {
            $this->product_type = 'variable_key';
            parent::__construct( $product );
        }

        public function get_type() {
            return 'variable_key';
        }
    }
}