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
 * @version   1.0.8-meqp
 * @author    E-Transactions <support@e-transactions.fr>
 * @copyright 2012-2021 E-Transactions
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.e-transactions.fr/
 */

namespace CreditAgricole\Etransactions\Gateway\Request;

use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Gateway\Data\PaymentDataObjectInterface;
use Magento\Payment\Gateway\Request\BuilderInterface;

class AuthorizationRequest implements BuilderInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /** @var \CreditAgricole\Etransactions\Model\Creditagricole */
    private $creditagricole;

    /**
     * @param ConfigInterface $config
     * @param \CreditAgricole\Etransactions\Model\Creditagricole $creditagricole
     */
    public function __construct(
        ConfigInterface $config,
        \CreditAgricole\Etransactions\Model\Creditagricole $creditagricole
    ) {
        $this->config = $config;
        $this->creditagricole = $creditagricole;
    }

    /**
     * Builds ENV request
     *
     * @param  array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        if (!isset($buildSubject['payment'])
            || !$buildSubject['payment'] instanceof PaymentDataObjectInterface
        ) {
            throw new \InvalidArgumentException('Payment data object should be provided');
        }

        /**
         * @var PaymentDataObjectInterface $payment
         */
        $payment = $buildSubject['payment'];
        $orderPayment = $payment->getPayment();
        $method = $orderPayment->getMethodInstance();
        if (!$method instanceof \CreditAgricole\Etransactions\Model\Payment\AbstractPayment) {
            throw new \InvalidArgumentException('An Etransactions payment method should be provided');
        }

        return $this->creditagricole->buildSystemParams($orderPayment->getOrder(), $method);
    }
}
