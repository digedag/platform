<?php

namespace Oro\Bundle\ApiBundle\Processor\GetList\RestJsonApi;

use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Oro\Bundle\ApiBundle\Processor\GetList\GetListContext;
use Oro\Bundle\ApiBundle\Request\JsonApi\JsonApiDocumentBuilderFactory;

class BuildJsonApiDocument implements ProcessorInterface
{
    /** @var JsonApiDocumentBuilderFactory */
    protected $documentBuilderFactory;

    /**
     * @param JsonApiDocumentBuilderFactory $documentBuilderFactory
     */
    public function __construct(JsonApiDocumentBuilderFactory $documentBuilderFactory)
    {
        $this->documentBuilderFactory = $documentBuilderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context)
    {
        /** @var GetListContext $context */

        $documentBuilder = $this->documentBuilderFactory->createDocumentBuilder();

        if ($context->hasResult()) {
            $result = $context->getResult();
            if (empty($result)) {
                $documentBuilder->setDataCollection($result);
            } else {
                $documentBuilder->setDataCollection($result, $context->getMetadata());
            }
        }

        $context->setResult($documentBuilder->getDocument());
    }
}
