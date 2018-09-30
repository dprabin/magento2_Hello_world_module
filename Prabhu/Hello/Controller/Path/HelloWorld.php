<?php

namespace Prabhu\Hello\Controller\Path;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class HelloWorld extends Action{

	/**
	 * HelloWorld constructor
	 * /
	protected $pageFactory;
	public function __construct(Context $context, PageFactory $pageFactory){
	    $this->pagefactory=$pageFactory;
	    parent::__construct($context);
	}

	/**
	 * Dispatch request
	 *
	 * @return \Magento\Framework\Controller\ResultInterface\ResponseInterface
	 * @throws \Magento\Framework\Exception\NotFoundException.
	 */
	public function execute(){
		return $this->pagefactory->create();

	}
}