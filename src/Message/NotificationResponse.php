<?php

namespace Omnipay\Two2Checkout\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Extend\Common\Message\AbstractResponse;

class NotificationResponse extends AbstractResponse
	implements NotificationInterface {

	/**
	 * Is the response successful?
	 *
	 * @return boolean
	 */
	public function isSuccessful() {
		// TODO: Implement isSuccessful() method.
	}

	/**
	 * Was the transaction successful?
	 *
	 * @return string Transaction status, one of {@see STATUS_COMPLETED}, {@see #STATUS_PENDING},
	 * or {@see #STATUS_FAILED}.
	 */
	public function getTransactionStatus() {
		// TODO: Implement getTransactionStatus() method.
	}
}