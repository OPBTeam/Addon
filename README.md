# Addon

Create simple addons for plugins.

## Simple Addon
```php
<?php

declare(strict_types=1);

use jojoe77777\FormAPI\SimpleForm;
use phuongaz\addon\Addon;
use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;

class FormAddon extends Addon implements Listener {

    public function __construct() {
        parent::__construct("FormAddon", "1.0.0", "phuongaz", "Test Addon Form");
    }

    public function execute(Plugin $plugin) : void {
        $plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
    }

    public function onCommandEvent(CommandEvent $event) :void {
        $command = $event->getCommand();
        $commandSender = $event->getSender();
        if($command === "skyblock" && $commandSender instanceof Player) {
            $commandSender->sendMessage("Test command for FormAddon");
            $this->sendForm($commandSender);
        }
        $event->cancel();
    }

    public function sendForm(Player $player) :void {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) {
                return;
            }
        });
        $form->setTitle("Test Form");
        $form->setContent("This is a test form");
        $form->addButton("Button 1");
        $form->addButton("Button 2");
        $form->addButton("Button 3");
        $player->sendForm($form);
    }

}
```

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
