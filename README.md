# Addon

Create simple addons for plugins.

## Simple Trait
```php
<?php

declare(strict_types=1);

namespace path\to\your\plugin;

use phuongaz\addon\Addon;
use phuongaz\addon\PluginAddon;
use pocketmine\plugin\Plugin;

trait AddonTrait {

    private static Plugin $plugin;
    private static PluginAddon $addon;

    public static function initAddon(Plugin $plugin, string $path) :void {
        self::$plugin = $plugin;
        self::$addon = new PluginAddon($plugin, $path);
        self::$addon->loadAddons();
    }

    public static function getAddonByName(string $name) :?Addon {
        return self::$addon->getAddonByName($name);
    }

    public static function getAddons() :array {
        return self::$addon->getAddons();
    }
}
```

```php
use AddonTrait;

public function onEnable() :void {
    self::initAddon($this, $this->getDataFolder() . "addons");
}

public function getAddons() :array {
    return self::getAddons();
}
```