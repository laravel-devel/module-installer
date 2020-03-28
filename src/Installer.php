<?php

namespace Devel\ModuleInstaller;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $name = $package->getName();

        if (strpos($name, '/') !== false) {
            $name = substr($name, strpos($name, '/') + 1);
        }

        if (strpos($name, '-devel-module') !== false) {
            $name = substr($name, 0, strpos($name, '-devel-module'));
        }

        if (strpos($name, '-module') !== false) {
            $name = substr($name, 0, strpos($name, '-module'));
        }

        $name = str_replace('-', ' ', $name);
        $name = str_replace('/', ' ', $name);
        $name = str_replace(' ', '', ucwords($name));

        return config('devel-modules.paths.modules') . '/' . $name;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'devel-module' === $packageType;
    }
}