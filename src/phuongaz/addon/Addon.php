<?php

declare(strict_types=1);

namespace phuongaz\addon;

use pocketmine\plugin\Plugin;

abstract class Addon {

    private string $name;
    private string $version;
    private string $author;
    private string $description;

    public function __construct(string $name, string $version, string $author, string $description = "") {
        $this->name = $name;
        $this->version = $version;
        $this->author = $author;
        $this->description = $description;
    }

    public function getName() :string {
        return $this->name;
    }

    public function getVersion() :string {
        return $this->version;
    }

    public function getAuthor() :string {
        return $this->author;
    }

    public function getDescription() :string {
        return $this->description;
    }

    abstract function execute(Plugin $plugin) :void;
}