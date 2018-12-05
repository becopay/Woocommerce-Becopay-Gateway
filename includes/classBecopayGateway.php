<?php
/**
 * User: Becopay Team
 * Version: 1.1.0
 * Date: 10/16/18
 * Time: 11:17 AM
 */

include_once 'interfaceBecopayGateway.php';

use Becopay\PaymentGateway;

/**
 * Class BecopayGateway
 * Becopay WooCommerce Payment Gateway class
 */
class BecopayGateway extends WC_Payment_Gateway implements interfaceBecopayGateway
{

    /**
     * @since    1.0.0
     * @access   private
     * @var object Becopay\PaymentGateway library object
     */
    private $payment;

    /**
     * @sinc 1.1.0
     * @access   private
     * @var string merchant currency
     */
    private $merchantCurrency;

    /**
     * @sinc 1.1.0
     * @access   private
     * @var array pattern for compare the response parameter value with request parameter
     */
    private $validatePattern = array(
        'payerAmount' => 'price',
        'payerCur' => 'currency',
        'merchantCur' => 'merchantCur',
        'orderId' => 'orderId',
        'description' => 'description'
    );

    /**
     * BecopayGateway constructor.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        //Within constructor, should be define the following variables:
        $this->id = BECOPAY_ID;
        $this->icon = BECOPAY_ICON;
        $this->has_fields = true;

        $this->method_title = __(BECOPAY_TITLE, 'becopay');
        $this->method_description = __(BECOPAY_PANEL_DESCRIPTION, 'becopay');

        $this->title = $this->get_option('title') ?: __(BECOPAY_TITLE, 'becopay');
        $this->description = $this->get_option('description') ?: __(BECOPAY_DESCRIPTION, 'becopay');

        $this->init_form_fields();
        $this->init_settings();

        // Init Becopay\PaymentGateway class
        $this->init_payment();

        //Add plugin configuration  to admin option
        if (version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>='))
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        else
            add_action('woocommerce_update_options_payment_gateways', array($this, 'process_admin_options'));

        //Add callback listener
        add_action('woocommerce_api_' . strtolower(get_class($this)) . '', array($this, 'checkInvoice'));

    }

    /**
     * Init Becopay\PaymentGateway class
     *
     * @since    1.1.0
     * @access   public
     */
    public function init_payment()
    {
        try {
            $this->payment = new PaymentGateway(
                $this->get_option('apiBaseUrl'),
                $this->get_option('apiKey'),
                $this->get_option('mobile')
            );
        } catch (\Exception $e) {

        }

        $this->merchantCurrency = $this->get_option('merchantCur') ?: BECOPAY_MERCHANT_CURRENCY;
    }

    /**
     * overwrite parent admin option function
     * save plugin form filed
     *
     * @since    1.0.0
     * @access   public
     */
    public function admin_options()
    {
        parent::admin_options();
    }

    /**
     * Init plugin configuration form filed
     *
     * @return mixed|void
     *
     * @since    1.1.0
     * @access   public
     */
    public function init_form_fields()
    {
        // TODO: Implement init_form_fields() method.
        $this->form_fields = array(
            'enabled' => array(
                'title' => __('Enable/Disable', 'woocommerce'),
                'type' => 'checkbox',
                'label' => __('Enable Becopay Payment', 'becopay'),
                'default' => 'no'
            ),
            'title' => array(
                'title' => __('Title', 'woocommerce'),
                'type' => 'text',
                'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
                'default' => __(BECOPAY_TITLE, 'becopay'),
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => __('Description', 'woocommerce'),
                'type' => 'text',
                'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
                'default' => __(BECOPAY_DESCRIPTION, 'becopay'),
                'desc_tip' => true,
            ),
            'mobile' => array(
                'title' => __('Mobile number', 'becopay'),
                'type' => 'text',
                'default' => '',
                'description' => __('Enter the phone number you registered in the Becopay here', 'becopay'),
                'desc_tip' => true,
            ),
            'apiBaseUrl' => array(
                'title' => __('Api base url', 'becopay'),
                'type' => 'text',
                'default' => '',
                'description' => __('Enter Becopay api base url here', 'becopay'),
                'desc_tip' => true,
            ),
            'apiKey' => array(
                'title' => __('Api key', 'becopay'),
                'type' => 'text',
                'default' => '',
                'description' => __('Enter your Becopay Api Key here', 'becopay'),
                'desc_tip' => true,
            ),
            'merchantCur' => array(
                'title' => __('Merchant Currency', 'becopay'),
                'type' => 'text',
                'default' => BECOPAY_MERCHANT_CURRENCY,
                'description' => __('Merchant receive currency. e.g. IRR, USD, EU', 'becopay'),
                'desc_tip' => true,
            )
        );
    }

    /**
     * Do payment process
     * Create Becopay invoice
     * then redirect user to becopay gateway for doing the payment process
     *
     * @param $order_id
     * @return array|mixed
     *
     * @since    1.1.0
     * @access   public
     */
    public function process_payment($order_id)
    {
        // TODO: Implement process_payment() method.
        $order = new WC_Order($order_id);

        try {
            //create unique payment order id for send to becopay
            $payment_order_id = uniqid($order_id . '-');
            $currency = $order->get_currency();
            $price = floatval($order->get_total());
            $description = implode(array(
                'orderId:' . $payment_order_id,
                'price:' . $price,
                'currency:' . $currency,
                'userEmail:' . $order->get_billing_email()
            ), ', ');

            //create Becopay invoice
            $invoice = $this->payment->create($payment_order_id, $price, $description, $currency, $this->merchantCurrency);
            if ($invoice) {

                //validate create invoice response
                if (!self::__validateResponse((object)array(
                    'price' => $price,
                    'currency' => $currency,
                    'merchantCur' => $this->merchantCurrency,
                    'orderId' => $payment_order_id,
                    'description' => $description
                ), $invoice)) {
                    wc_add_notice('Invalid response from payment gateway', 'error');
                    return false;
                }

                //Save payment order id, if exist update new paymentOrderId
                if (!add_post_meta($order_id, '_BecopayOrderId', $payment_order_id, true))
                    update_post_meta($order_id, '_BecopayOrderId', $payment_order_id);

                //Save Becopay InvoiceId, if exist update new InvoiceId
                if (!add_post_meta($order_id, '_BecopayInvoiceId', $invoice->id, true))
                    update_post_meta($order_id, '_BecopayInvoiceId', $invoice->id);

                //Add note on user order pay and set
                $order->add_order_note(__('Becopay payment invoice id is', 'becopay') . ' ' . $invoice->id, 1);

                //Add note on order page for admin
                $order->add_order_note(
                    __('Customer checkout:', 'becopay') . ' ' . $invoice->payerAmount . ' ' . $invoice->payerCur . ', ' .
                    __('Merchant Receive', 'becopay') . ' ' . $invoice->merchantAmount . ' ' . $invoice->merchantCur
                    , 0);

                // Return thank you redirect
                return array(
                    'result' => 'success',
                    'redirect' => $invoice->gatewayUrl,//$this->get_return_url( $order )
                );
            } else {
                //return failure
                wc_add_notice($this->payment->error, 'error');

            }
        } catch (\Exception $e) {
            //return error
            wc_add_notice($e->getMessage(), 'error');
        }


    }

    /**
     * Check order payment status on api callback
     *
     * @since    1.1.0
     * @access   public
     */
    public function checkInvoice()
    {
        global $woocommerce;

        //get payment order id
        $callback_order_id = isset($_GET['orderId']) ? $_GET['orderId'] : '';

        //split payment order id and get order_id
        $order_id = reset(explode('-', $callback_order_id));

        //check order id is exist
        if (!wc_get_order($order_id) || get_post_meta($order_id, '_BecopayOrderId', true) != $callback_order_id) {
            wp_redirect(site_url());
            exit;
        }

        //Get Becopay payment invoiceId, if not exist redirect to checkout page
        $invoice_id = get_post_meta($order_id, '_BecopayInvoiceId', true);
        if (!$invoice_id) {
            wp_redirect($woocommerce->cart->get_checkout_url());
            exit;
        }

        $order = new WC_Order($order_id);

        if ($order->status == 'pending') {

            //Checking the invoice status
            $checkInvoice = $this->payment->check($invoice_id);

            if ($checkInvoice) {

                $currency = $order->get_currency();
                $price = floatval($order->get_total());

                //if status is waiting return to checkout page
                if ($checkInvoice->status == 'waiting') {
                    wp_redirect($woocommerce->cart->get_checkout_url());
                    exit;
                } //if Becopay payment price with wc_order price is not same redirect to checkout page
                else if ($checkInvoice->payerAmount != $price || $checkInvoice->payerCur != $currency) {
                    $order->add_order_note(
                        __('Becopay payment price or currency is not same with your order.', 'becopay') . ' ' .
                        __('invoice id', 'becopay') . ' ' . $checkInvoice->id, 1);

                    wp_redirect($woocommerce->cart->get_checkout_url());
                    exit;
                } //if status is success complete the payment
                else if ($checkInvoice->status == 'success'){
                    $order->payment_complete($order_id);
                    $woocommerce->cart->empty_cart();

                    $order->add_order_note(
                        __('The invoice was successfully paid', 'becopay') . ' ' .
                        __('invoice id', 'becopay') . ' ' . $checkInvoice->id, 1);

                    wp_redirect(add_query_arg('wc_status', 'success', $this->get_return_url($order)));
                    exit;
                }
            }
        }
        error_log('error condition');
        //if is not match none of the condition redirect to checkout page
        wp_redirect($woocommerce->cart->get_checkout_url());
        exit;
    }

    /**
     * Validate the response parameter with request parameter according the validate pattern
     *
     * @param $request object of request parameter
     * @param $response object of response parameter
     * @return bool
     */
    private function __validateResponse($request, $response)
    {
        foreach ($this->validatePattern as $res_value => $req_value)
            if ($response->$res_value != $request->$req_value)
                return false;
        return true;
    }
}