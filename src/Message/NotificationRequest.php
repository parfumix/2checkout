<?php

namespace Omnipay\Two2Checkout\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Extend\Common\Message\AbstractRequest;

class NotificationRequest extends AbstractRequest {

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData() {
		$data = $this->httpRequest->request->all();
		$data['secretWord']    = $this->getSecretWord();
		$data['accountNumber'] = $this->getAccountNumber();

		return $data;
	}

	/**
	 * Send the request with specified data
	 *
	 * @param  mixed $data The data to send
	 * @return ResponseInterface
	 */
	public function sendData($data) {
		return new NotificationResponse($this, $data);
	}
}