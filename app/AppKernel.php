<?php

use Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Class AppKernel
 *
 * @author Steve Todorov <steve.todorov@carlspring.com>
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array(new \Symfony\Bundle\FrameworkBundle\FrameworkBundle());

        // This small hack allows to register custom
        // bundles required for executing tests. Make sure
        // that registerBundles function returns an array.
        if (function_exists('registerBundles')) {
            $bundles = array_merge($bundles, registerBundles());
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
        // This small hack allows to register custom
        // configuration files for executing tests.
        if (function_exists('registerContainerConfiguration')) {
            registerContainerConfiguration($loader);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir() {
        return sys_get_temp_dir().'/SymfonyBundleTesting/cache';
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir() {
        return sys_get_temp_dir().'/SymfonyBundleTesting/logs';
    }
}