<?php

namespace Omnipay\Two2Checkout;

trait GatewayExtend {

	/**
	 * Set sid .
	 *
	 * @param $sid
	 * @return $this
	 */
	public function setSid($sid) {
		$this->setParameter('sid', $sid);

		return $this;
	}

	/**
	 * Get sid .
	 *
	 * @return mixed
	 */
	public function getSid() {
		return $this->getParameter('sid');
	}

	/**
	 * Getter: 2Checkout account number.
	 *
	 * @return string
	 */
	public function getAccountNumber() {
		return $this->getParameter('accountNumber');
	}

	/**
	 * Setter: 2Checkout account number.
	 *
	 * @param $value
	 *
	 * @return $this
	 */
	public function setAccountNumber($value) {
		return $this->setParameter('accountNumber', $value);
	}

	/**
	 * Getter: 2Checkout secret word.
	 *
	 * @return string
	 */
	public function getSecretWord() {
		return $this->getParameter('secretWord');
	}

	/**
	 * Setter: 2Checkout secret word.
	 *
	 * @param $value
	 *
	 * @return $this
	 */
	public function setSecretWord($value) {
		return $this->setParameter('secretWord', $value);
	}

}