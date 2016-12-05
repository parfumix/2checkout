<?php

namespace Parfumix\TwoCheckout\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest {

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData() {
		$this->validate('accountNumber', 'returnUrl');

		$data = array();
		$data['sid'] = $this->getParameter('sid');
		$data['mode'] = '2CO';
		$data['merchant_order_id'] = $this->getTransactionId();
		$data['currency_code'] = $this->getCurrency();
		$data['x_receipt_link_url'] = $this->getReturnUrl();

		// Do not pass for live sales i.e if its false.
		if ( $this->getTestMode() )
			$data['demo'] = 'Y';

		if ( $language = $this->getParameter('language') )
			$data['lang'] = $language;

		if ( $coupon = $this->getParameter('coupon') )
			$data['coupon'] = $coupon;

		// needed to determine which API endpoint to use in OffsiteResponse
		if ( $this->getTestMode() )
			$data['sandbox'] = true;

		$i = 0;

		// Setup Products information
		foreach ($this->getItems() as $item) {
			$data['li_'.$i.'_type'] = $item['type'];
			$data['li_'.$i.'_name'] = $item['name'];
			$data['li_'.$i.'_price'] = $item['price'];
			$data['li_'.$i.'_quantity'] = $item['quantity'];

			// optional item/product parameters
			if (isset($item['tangible'])) {
				$data['li_'.$i.'_tangible'] = $item['tangible'];
			}
			if (isset($item['product_id'])) {
				$data['li_'.$i.'_product_id'] = $item['product_id'];
			}
			if (isset($item['description'])) {
				$data['li_'.$i.'_description'] = $item['description'];
			}
			if (isset($item['recurrence'])) {
				$data['li_'.$i.'_recurrence'] = $item['recurrence'];
			}
			if (isset($item['duration'])) {
				$data['li_'.$i.'_duration'] = $item['duration'];
			}
			if (isset($item['startup_fee'])) {
				$data['li_'.$i.'_startup_fee'] = $item['startup_fee'];
			}

			++$i;
		}

		if ($this->getCard()) {
			$data['card_holder_name'] = $this->getCard()->getName();
			$data['street_address'] = $this->getCard()->getAddress1();
			$data['street_address2'] = $this->getCard()->getAddress2();
			$data['city'] = $this->getCard()->getCity();
			$data['state'] = $this->getCard()->getState();
			$data['zip'] = $this->getCard()->getPostcode();
			$data['country'] = $this->getCard()->getCountry();
			$data['phone'] = $this->getCard()->getPhone();
			$data['email'] = $this->getCard()->getEmail();
		}

		return $data;
	}

	/**
	 * Send the request with specified data
	 *
	 * @param  mixed $data The data to send
	 * @return ResponseInterface
	 */
	public function sendData($data) {
		return new PurchaseResponse($this, $data);
	}
}
