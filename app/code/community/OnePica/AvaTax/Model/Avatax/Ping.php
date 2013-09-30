<?php
/**
 * OnePica_AvaTax
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0), a
 * copy of which is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   OnePica
 * @package    OnePica_AvaTax
 * @author     OnePica Codemaster <codemaster@onepica.com>
 * @copyright  Copyright (c) 2009 One Pica, Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */


class OnePica_AvaTax_Model_Avatax_Ping extends OnePica_AvaTax_Model_Avatax_Abstract
{
	
	/**
	 * Tries to ping AvaTax service with provided credentials
	 *
	 * @param int $storeId
	 * @return bool|array
	 */
	public function ping($storeId = null) {
		$config = Mage::getSingleton('avatax/config')->init($storeId);
		$connection = $config->getTaxConnection();
		$result = null;
		$message = null;
		
		try { $result = $connection->ping(); }
		catch(Exception $exception) { $message = $exception->getMessage(); }
		
		if(!isset($result) || !is_object($result) || !$result->getResultCode()) {
			$actualResult = $result;
			$result = new Varien_Object;
			$result->setResultCode(SeverityLevel::$Exception);
			$result->setActualResult($actualResult);
			$result->setMessage($message);
		}
		
		$this->_log(new stdClass(), $result, $storeId);
		return ($result->getResultCode() == SeverityLevel::$Success) ? true : $result->getMessage();
	}
	
}