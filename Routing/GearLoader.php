<?php

namespace Gear\Routing;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Gear\Routing\Factory\RouteCollectionFactory;
use Gear\Routing\Parser\YamlParser;
use Gear\Routing\Builder\RouteBuilderInterface;

class GearLoader implements LoaderInterface
{
    private $builders;
    private $parser;
    private $locator;
    private $factory;

    public function __construct(
        FileLocatorInterface   $locator,
        YamlParser             $parser = null,
        RouteCollectionFactory $factory = null
    )
    {
        $this->builders = [];
        $this->locator  = $locator;
        $this->parser   = $parser ?: new YamlParser;
        $this->factory  = $factory ?: new RouteCollectionFactory;
    }

    public function load($resource, $type = null)
    {
        if (!$filePath = $this->locator->locate($resource)) {
            throw new \InvalidArgumentException(sprintf(
                'The resource %s not exists',
                $resource
            ));
        }

        $gearRoutes = $this->parser->parse($filePath);
        $routeCollection = $this->factory->create();

        foreach ($gearRoutes as $key => $options) {
            $explodeKey = explode(':', $key);
            $name        = array_shift($explodeKey);
            $arguments   = $explodeKey;

            foreach ($this->builders as $builder) {
                if ($name === $builder->getName()) {
                    $builder->build(
                        $routeCollection,
                        $arguments,
                        $options
                    );
                    break;
                }
            }
        }

        return $routeCollection;
    }

    public function addBuilder(RouteBuilderInterface $builder)
    {
        $this->builders[] = $builder;
    }

    public function supports($resource, $type = null)
    {
        return 'gear' === $type;
    }

    public function getResolver()
    {
    }

    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}
