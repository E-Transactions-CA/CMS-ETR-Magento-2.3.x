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
 * @version   1.0.7-psr
 * @author    E-Transactions <support@e-transactions.fr>
 * @copyright 2012-2021 E-Transactions
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.e-transactions.fr/
 */

namespace CreditAgricole\Etransactions\Model\Admin\Payment;

class Delays
{
    public function toOptionArray()
    {
        $result = [
            '1' => ['value' => 1, 'label' => __('1')],
            '2' => ['value' => 2, 'label' => __('2')],
            '3' => ['value' => 3, 'label' => __('3')],
            '4' => ['value' => 4, 'label' => __('4')],
            '5' => ['value' => 5, 'label' => __('5')],
            '6' => ['value' => 6, 'label' => __('6')],
            '7' => ['value' => 7, 'label' => __('7')],
        ];
        return $result;
    }
}
