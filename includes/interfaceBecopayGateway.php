<?php
/**
 * Most methods are inherited from the WC_Payment_Gateway class, but some are required.
 *
 * User: Becopay Team
 * Version: 1.0.0
 * Date: 10/16/18
 * Time: 11:16 AM
 */

interface interfaceBecopayGateway
{

    /**
     * interfaceGateway constructor.
     */
    public function __construct();

    /**
     * @return mixed
     */
    public function init_form_fields();

    /**
     * @param $order_id
     * @return mixed
     */
    public function process_payment($order_id);
}