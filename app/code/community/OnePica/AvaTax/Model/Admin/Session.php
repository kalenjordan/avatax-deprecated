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


class OnePica_AvaTax_Model_Admin_Session extends Mage_Admin_Model_Session
{

    /**
     * Check current user permission on resource and privilege
     *
     * Mage::getSingleton('admin/session')->isAllowed('admin/catalog')
     * Mage::getSingleton('admin/session')->isAllowed('catalog')
     *
     * @param   string $resource
     * @param   string $privilege
     * @return  boolean
     */
    public function isAllowed($resource, $privilege=null)
    {
    	$block = array(
    		'admin/sales/tax/rules',
    		'admin/sales/tax/rates',
    		'admin/sales/tax/import_export'
    	);
    	
    	if(in_array($resource, $block) && !Mage::helper('avatax')->isAnyStoreDisabled()) {
    		return false;
    	} else {
    		return parent::isAllowed($resource, $privilege);
    	}
    }
}
