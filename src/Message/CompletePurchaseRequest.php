<?php

namespace Omnipay\Two2Checkout\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends PurchaseRequest {

	/**
	 * Get data .
	 *
	 * @return mixed
	 * @throws InvalidResponseException
	 */
	public function getData() {
		// if 2co didn't send a POST body parameters, use sent GET string parameters instead.
		// Note: when redirect is set to Header redirect in 2co dashboard, transaction parameters are GET query string.
		$request_type = empty($this->httpRequest->request->all())
			? 'query'
			: 'request';

		$orderNo     = $this->httpRequest->$request_type->get('order_number');
		$orderAmount = $this->httpRequest->$request_type->get('total');

		// strange exception specified by 2Checkout
		if ( $this->getTestMode() )
			$orderNo = '1';

		$key = strtoupper(md5($this->getSecretWord() . $this->getSid() . $orderNo . $orderAmount));

		if ($this->httpRequest->$request_type->get('key') !== $key)
			throw new InvalidResponseException('Invalid key');

		return $this->httpRequest->$request_type->all();
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param mixed $data
	 *
	 * @return CompletePurchaseResponse
	 */
	public function sendData($data) {
		return $this->response = new CompletePurchaseResponse($this, $data);
	}
}
