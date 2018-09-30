<?php

namespace Prabhu\Hello\Controller\Path;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class HelloWorld extends Action{

	/**
	 * Dispatch request
	 *
	 * @return \Magento\Framework\Controller\ResultInterface\ResponseInterface
	 * @throws \Magento\Framework\Exception\NotFoundException.
	 */
	public function execute(){
		//TODO: Implement execute() method
		echo "Hello World";

	}
}