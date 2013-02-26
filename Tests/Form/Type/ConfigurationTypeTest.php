<?php
namespace Oro\Bundle\DataFlowBundle\Tests\Form\Type;

use Oro\Bundle\DataFlowBundle\Tests\Form\Demo\MyConfigurationType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\Tests\OrmTestCase;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

/**
 * Test related class
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/MIT MIT
 *
 */
class ConfigurationTypeTest extends OrmTestCase
{

    /**
     * @var MyConfigurationType
     */
    protected $formType;

    /**
     * Setup
     */
    public function setup()
    {
        // prepare test entity manager
        $entityPath = 'Oro\\Bundle\\DataFlowBundle\\Test\\Entity\\Demo';
        $reader = new AnnotationReader();
        $metadataDriver = new AnnotationDriver($reader, $entityPath);
        $entityManager = $this->_getTestEntityManager();
        $entityManager->getConfiguration()->setMetadataDriverImpl($metadataDriver);

        $this->formType = new MyConfigurationType($entityManager);
    }

    /**
     * Test related method
     */
    public function testBuildForm()
    {
        $dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $factory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        $builder = new FormBuilder('name', null, $dispatcher, $factory);
        $this->formType->buildForm($builder, array());
    }
}
