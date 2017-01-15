<?php

namespace Iulyanp\ElixirMixBundle\Twig;

/**
 * Class MixExtension.
 */
class MixExtension extends \Twig_Extension
{
    /** @var string */
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
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('mix', [$this, 'mix']),
        ];
    }

    /**
     * @param $asset
     *
     * @throws \Exception
     *
     * @return string
     */
    public function mix($asset)
    {
        $asset = trim($asset, '/');

        $manifest = $this->readManifest();

        $flatten = $this->flattenArray($manifest['assetsByChunkName']);

        return $this->getVersionedFile($asset, $flatten, $manifest);
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
     * @return array
     * @throws \Exception
     */
    private function readManifest()
    {
        static $manifest;

        if (! $manifest) {
            $manifestPath = $this->webDir.'/../Mix.json';

            if (! file_exists($manifestPath)) {
                throw new \Exception(
                    'The Laravel Mix manifest file does not exist. ' .
                    'Please run "npm run webpack" and try again.'
                );
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        return $manifest;
    }

    /**
     * @param $array
     * @param $depth
     *
     * @return array
     */
    public function flattenArray($array, $depth = INF)
    {
        return array_reduce($array, function ($result, $item) use ($depth) {
            if (! is_array($item)) {
                return array_merge($result, [$item]);
            } elseif ($depth === 1) {
                return array_merge($result, array_values($item));
            } else {
                return array_merge($result, static::flattenArray($item, $depth - 1));
            }
        }, []);
    }

    /**
     * @param $file
     * @param $flatten
     * @param $manifest
     *
     * @return array
     */
    private function getVersionedFile($file, $flatten, $manifest)
    {
        $versionedFile = array_filter(
            $flatten,
            function ($compiledFile) use ($file, $manifest) {
                $compiledFileOriginal = trim(str_replace($manifest['hash'].'.', '', $compiledFile), '/');

                return ($file == $compiledFileOriginal) ? $compiledFile : null;
            }
        );

        return reset($versionedFile);
    }
}
