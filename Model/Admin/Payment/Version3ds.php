<?php
/**
 * E-Transactions Etransactions module for Magento
 *
 * Feel free to contact E-Transactions at support@e-transactions.fr for any
 * question.
 *
 * LICENSE: This source file is subject to the version 3.0 of the Open
 * Software License (OSL-3.0) that is available through the world-wide-web
 * at the following URI: http://opensource.org/licenses/OSL-3.0. If
 * you did not receive a copy of the OSL-3.0 license and are unable
 * to obtain it through the web, please send a note to
 * support@e-transactions.fr so we can mail you a copy immediately.
 *
 * @version   2.0.1
 * @author    E-Transactions <support@e-transactions.fr>
 * @copyright 2012-2017 E-Transactions
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.e-transactions.fr/
 */

namespace CreditAgricole\Etransactions\Model\Admin\Payment;

class Version3ds
{
    public function toOptionArray()
    {
        $options = [
            ['value' => '1', 'label' => __('3DS v1')],
            ['value' => '2', 'label' => __('3DS v2 (default)')],
        ];
        return $options;
    }
}
