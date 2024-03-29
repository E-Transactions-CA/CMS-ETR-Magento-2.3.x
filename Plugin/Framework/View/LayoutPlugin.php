<?php
/**
 * Up2pay e-Transactions Etransactions module for Magento
 *
 * Feel free to contact Credit Agricole at support@e-transactions.fr for any
 * question.
 *
 * LICENSE: This source file is subject to the version 3.0 of the Open
 * Software License (OSL-3.0) that is available through the world-wide-web
 * at the following URI: http://opensource.org/licenses/OSL-3.0. If
 * you did not receive a copy of the OSL-3.0 license and are unable
 * to obtain it through the web, please send a note to
 * support@e-transactions.fr so we can mail you a copy immediately.
 *
 * @version   1.0.8
 * @since     1.0.8
 * @author    E-Transactions <support@e-transactions.fr>
 * @copyright 2012-2021 E-Transactions
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.e-transactions.fr/
 */

namespace CreditAgricole\Etransactions\Plugin\Framework\View;

class LayoutPlugin
{
    protected $_registry;

    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->_registry = $registry;
    }

    public function aroundIsCacheable(\Magento\Framework\View\Layout $subject, callable $proceed)
    {
        if ($this->_registry->registry('etep_forward_nocache')) {
            return false;
        }
        return $proceed();
    }
}