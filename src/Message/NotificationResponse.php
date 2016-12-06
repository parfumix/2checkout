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
		$hashSecretWord = $this->data['secretWord'];
		$hashSid = $this->data['accountNumber'];
		$hashOrder = $this->data['sale_id'];
		$hashInvoice = $this->data['invoice_id'];
		$StringToHash = strtoupper(md5($hashOrder.$hashSid.$hashInvoice.$hashSecretWord));

		return $StringToHash == $this->data['md5_hash'];
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