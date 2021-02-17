<?php
/**
 * E-Transactions Epayment module for Magento
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
 * @version   1.0.7-psr
 * @author    E-Transactions <support@e-transactions.fr>
 * @copyright 2012-2017 E-Transactions
 * @license   http://opensource.org/licenses/OSL-3.0
 * @link      http://www.e-transactions.fr/
 */

namespace ETransactions\Epayment\Gateway\Validator;

use Magento\Payment\Gateway\Validator\AbstractValidator;
use Magento\Payment\Gateway\Validator\ResultInterface;
use ETransactions\Epayment\Gateway\Http\Client\ClientMock;

class ResponseCodeValidator extends AbstractValidator
{
    const RESULT_CODE = 'RESULT_CODE';

    /**
     * Performs validation of result code
     *
     * @param  array $validationSubject
     * @return ResultInterface
     */
    public function validate(array $validationSubject)
    {
        if (!isset($validationSubject['response']) || !is_array($validationSubject['response'])) {
            throw new \InvalidArgumentException('Response does not exist');
        }

        $response = $validationSubject['response'];

        if ($this->isSuccessfulTransaction($response)) {
            return $this->createResult(
                true,
                []
            );
        } else {
            return $this->createResult(
                false,
                [__('Gateway rejected the transaction.')]
            );
        }
    }

    /**
     * @param array $response
     * @return bool
     */
    private function isSuccessfulTransaction(array $response)
    {
        return isset($response[self::RESULT_CODE])
        && $response[self::RESULT_CODE] !== ClientMock::FAILURE;
    }
}
