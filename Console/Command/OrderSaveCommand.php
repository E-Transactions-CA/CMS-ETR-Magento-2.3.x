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

namespace CreditAgricole\Etransactions\Console\Command;

use Magento\Framework\App\ObjectManager\ConfigLoader;
use Magento\Framework\App\ObjectManagerFactory;
use Magento\Framework\App\State;
use Magento\Store\Model\StoreManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class OrderSaveCommand extends Command
{
    protected $objectManager;
    protected $_order;

    public function __construct(
        ObjectManagerFactory $objectManagerFactory
    ) {
        $params = $_SERVER;
        $params[StoreManager::PARAM_RUN_CODE] = 'admin';
        $params[StoreManager::PARAM_RUN_TYPE] = 'store';
        $this->objectManager = $objectManagerFactory->create($params);
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('creditagricole:saveorder')
            ->setDescription('Test : Call save method for Order')
            ->setDefinition($this->getInputList());
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->addArguments($input);
        $output->writeln('<info>Starting CreditAgricole SaveOrder Test</info>');

        if (!empty($this->_order)) {
            $output->writeln("Order = {$this->_order}");
            $order = $this->objectManager->get('Magento\Sales\Model\Order');
            $order->load($this->_order);
            $order->addStatusHistoryComment('toto');
            $order->save();
            $output->writeln("Order Saved");
        }

        $output->writeln('<info>End CreditAgricole SaveOrder Test</info>');
    }

    public function addArguments($input)
    {
        $this->_order = intval($input->getArgument("order"));
    }

    public function getInputList()
    {
        $inputList = [];
        $inputList[] = new InputArgument('order', InputArgument::OPTIONAL, 'Order Id');
        return $inputList;
    }
}
