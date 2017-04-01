<?php

namespace Iulyanp\ElixirMixBundle\Twig;

/**
 * Class MixExtension.
 */
class MixExtension extends \Twig_Extension
{
    const MANIFEST = 'mix-manifest.json';
    /**
     * @var string
     */
    protected $webDir;

    /**
     * MixExtension constructor.
     *
     * @param string $webDir
     */
    public function __construct($webDir)
    {
        $this->webDir = $webDir;
    }

    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('mix', [$this, 'mix']),
        ];
    }

    /**
     * Get the mix file from the manifest
     *
     * @param string $asset The needed asset
     *
     * @throws \Exception
     * @return string
     */
    public function mix($asset)
    {
        $manifest = $this->readManifest();

        if (!array_key_exists($asset, $manifest)) {
            throw new \Exception(
                sprintf(
                    'The "%s" key could not be found in the manifest file. %s',
                    $asset,
                    'Please pass just the asset filename as a parameter to the mix() method.'
                )
            );
        }

        return $manifest[$asset];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'mix';
    }

    /**
     * Read the manifest file if exists
     *
     * @return array
     * @throws \Exception
     */
    private function readManifest()
    {
        static $manifest;

        if (!$manifest) {
            $manifestPath = sprintf('%s/%s', $this->webDir, self::MANIFEST);

            if (!file_exists($manifestPath)) {
                throw new \Exception(
                    'The Laravel Mix manifest file does not exist. ' .
                    'Please run "npm run webpack" and try again.'
                );
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        return $manifest;
    }
}
