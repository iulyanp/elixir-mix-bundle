<?php

namespace Iulyanp\ElixirMixBundle\Tests\DependencyInjection;

use Iulyanp\ElixirMixBundle\DependencyInjection\IulyanpElixirMixExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class IulyanpElixirMixExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return [
            new IulyanpElixirMixExtension(),
        ];
    }

    public function testConfiguration()
    {
        $config = [
            'web_dir' => '/path/to/manifest.json',
        ];

        $this->load($config);

        $this->assertContainerBuilderHasParameter('web_dir', '/path/to/manifest.json');
    }
}
