<?php

namespace Omnipay\Two2Checkout;

use Omnipay\Extend\Common\AbstractGateway;
use Omnipay\Two2Checkout\Message\CompletePurchaseRequest;
use Omnipay\Two2Checkout\Message\NotificationRequest;
use Omnipay\Two2Checkout\Message\PurchaseRequest;

class Gateway extends AbstractGateway {

	use GatewayExtend;

	/**
	 * Get gateway display name
	 *
	 * This can be used by carts to get the display name for each gateway.
	 */
	public function getName() {
		return 'Two2Checkout';
	}

	/**
	 * Get gateway default parameters .
	 *
	 * @return array
	 */
	public function getDefaultParameters() {
		return array(
			'sid' => null,
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

	/**
	 * Accept notifications .
	 *
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function acceptNotification(array $options = array()) {
		return $this->createRequest(NotificationRequest::class, $options);
	}
}
