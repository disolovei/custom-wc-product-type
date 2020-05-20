<?php
if ( ! class_exists( 'WC_Product_Variable_Cylinder' ) ) {
    class WC_Product_Variable_Cylinder extends WC_Product_Variable {

        public function __construct( $product = 0 ) {
            $this->product_type = 'variable_cylinder';
            parent::__construct( $product );
        }

        public function get_type() {
            return 'variable_cylinder';
        }
    }
}