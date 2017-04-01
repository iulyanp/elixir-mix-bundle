<?php

namespace Iulyanp\ElixirMixBundle\Tests\Twig;

use Iulyanp\ElixirMixBundle\Twig\MixExtension;
use PHPUnit_Framework_TestCase;

/**
 * Class ElixirMixExtensionTest
 */
class ElixirMixExtensionTest extends PHPUnit_Framework_TestCase
{
    const WEB_DIR = __DIR__.'/stub';

    /**
     * @var MixExtension
     */
    private $mixExtension;

    /**
     * Set UP.
     *
     * Instantiate ElixirExtension for all tests
     */
    public function setUp()
    {
        $this->mixExtension = new MixExtension(self::WEB_DIR);
    }

    /**
     * @test
     */
    public function mixFunctionReturnManifest()
    {
        $this->assertEquals(
            'css/app-db9165hf67.css',
            $this->mixExtension->mix('css/app.css')
        );
        $this->assertEquals(
            'css/index-9rt53c9u67.css',
            $this->mixExtension->mix('css/index.css')
        );
        $this->assertEquals(
            'js/app-db9183c967.js',
            $this->mixExtension->mix('js/app.js')
        );
    }

    /**
     * @test
     */
    public function elixirFunctionThrowsErrorWhenFileNotExists()
    {
        $this->expectException('\Exception');
        $this->expectExceptionMessage(
            'The "css/not_existing.css" key could not be found in the manifest file. '.
            'Please pass just the asset filename as a parameter to the mix() method.'
        );
        $this->mixExtension->mix('css/not_existing.css');
    }
}
