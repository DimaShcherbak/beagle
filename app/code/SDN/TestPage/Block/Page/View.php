<?php
declare(strict_types=1);

namespace SDN\TestPage\Block\Page;

use Magento\Catalog\Model\Category;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class View extends Template
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param Context $context
     * @param Category $category
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context  $context,
        Category $category,
        Registry $registry,
        array    $data = []
    )
    {
        parent::__construct($context, $data);
        $this->category = $category;
        $this->registry = $registry;
    }

    /**
     * @return mixed|null
     */
    public function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    public function test() {
        return "hello MF MF MF";
    }
}

