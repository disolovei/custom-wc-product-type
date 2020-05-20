<?php
if ( class_exists( 'WC_Product_Variable' ) ) {
    function prefix_register_custom_product_types() {
        include_once 'classes/class-wc-product-variable-key.php';
        include_once 'classes/class-wc-product-variable-reader.php';
        include_once 'classes/class-wc-product-variable-cylinder.php';
    }
    add_action( 'init', 'prefix_register_custom_product_types' );

    function prefix_get_custom_product_types() {
        return array(
            'variable_key'       => __( 'Key', 'textdomain' ),
            'variable_cylinder'  => __( 'Cylinder', 'textdomain' ),
            'variable_reader'    => __( 'Reader', 'textdomain' ),
        );
    }

    function prefix_product_type_selector( $types ) {
        return array_merge( prefix_get_custom_product_types(), $types );
    }
    add_filter( 'product_type_selector', 'prefix_product_type_selector' );

    function prefix_product_data_tabs( $tabs ) {
        $new_conditions = array( 'show_if_variable_key', 'show_if_variable_cylinder', 'show_if_variable_reader' );


        $tabs['variations']['class']    = array_merge( $new_conditions, $tabs['variations']['class'] );
        $tabs['inventory']['class']     = array_merge( $new_conditions, $tabs['inventory']['class'] );


        return $tabs;
    }
    add_filter( 'woocommerce_product_data_tabs', 'prefix_product_data_tabs', 20 );

    function prefix_product_class( $classname, $product_type ) {
        if ( 'variable_key' === $product_type ) {
            return 'WC_Product_Variable_Key';
        } elseif ( 'variable_cylinder' === $product_type ) {
            return 'WC_Product_Variable_Cylinder';
        } elseif ( 'variable_reader' === $product_type ) {
            return 'WC_Product_Variable_Reader';
        }


        return $classname;
    }
    add_filter( 'woocommerce_product_class', 'prefix_product_class', 10, 2 );

    function prefix_data_stores( $stores ) {
        $stores['product-variable_key']         = 'WC_Product_Variable_Data_Store_CPT';
        $stores['product-variable_cylinder']    = 'WC_Product_Variable_Data_Store_CPT';
        $stores['product-variable_reader']      = 'WC_Product_Variable_Data_Store_CPT';


        return $stores;
    }
    add_filter( 'woocommerce_data_stores', 'prefix_data_stores' );

    function prefix_enable_custom_product_types_variation( $attribute, $i ) {
        ?>

        <tr>
            <td>
                <div class="enable_variation show_if_variable_key show_if_variable_cylinder show_if_variable_reader">
                    <label><input type="checkbox" class="checkbox" <?php checked( $attribute->get_variation(), true ); ?> name="attribute_variation[<?php echo esc_attr( $i ); ?>]" value="1" /> <?php esc_html_e( 'Used for variations', 'woocommerce' ); ?></label>
                </div>
            </td>
        </tr>

        <?php
    }
    add_action( 'woocommerce_after_product_attribute_settings', 'prefix_enable_custom_product_types_variation', 10, 2 );
}