<?php

namespace Parfumix\TwoCheckout;

use Omnipay\Common\AbstractGateway;
use Parfumix\TwoCheckout\Message\CompletePurchaseRequest;
use Parfumix\TwoCheckout\Message\PurchaseRequest;

class Gateway extends AbstractGateway {

	/**
	 * Get gateway display name
	 *
	 * This can be used by carts to get the display name for each gateway.
	 */
	public function getName() {
		return '2Checkout';
	}

	/**
	 * Get gateway default parameters .
	 *
	 * @return array
	 */
	public function getDefaultParameters() {
		return array(
			'accountNumber' => null,
			'secretWord' => null,
			// if true, transaction with the live checkout URL will be a demo sale and card won't be charged.
			'testMode' => false,
		);
	}

	/**
	 * Implement purchase request method .
	 *
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function purchase(array $options = array()) {
		return $this->createRequest(PurchaseRequest::class, $options);
	}

	/**
	 * Complete purchase request .
	 *
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function completePurchase(array $options = array()) {
		return $this->createRequest(CompletePurchaseRequest::class, $options);
	}

}
