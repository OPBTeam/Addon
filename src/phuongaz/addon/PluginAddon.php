<?php

declare(strict_types=1);

namespace phuongaz\addon;

use pocketmine\plugin\Plugin;

class PluginAddon
{
    private array $addons;
    private string $path;
    private Plugin $plugin;

    public function __construct(Plugin $plugin, string $path)
    {
        $this->path = $path . DIRECTORY_SEPARATOR;
        $this->plugin = $plugin;
    }

    public function loadAddons(): void
    {
        $addonDir = $this->path;
        $addonFiles = scandir($addonDir);
        foreach ($addonFiles as $filename) {
            if (is_file($addonDir . $filename) && pathinfo($filename, PATHINFO_EXTENSION) === 'php') {
                require_once $addonDir . $filename;
                $className = pathinfo($filename, PATHINFO_FILENAME);
                $fqClassName = $className;
                if (class_exists($fqClassName) && is_subclass_of($fqClassName, Addon::class)) {
                    $instance = new $fqClassName();
                    $this->addons[$fqClassName] = $instance;
                    $instance->execute($this->plugin);
                }
            }
        }
    }

    public function getAddons() : array {
        return $this->addons;
    }

    public function getAddonByName(string $name) : ?Addon {
        return ($this->addons[$name] ?? null);
    }

}