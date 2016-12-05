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

}