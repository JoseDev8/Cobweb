<?php

namespace Cobweb;

use Cobweb\command\CobwebCommand;
use Cobweb\item\CobwebItem;
use Cobweb\listener\ItemListener;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Loader extends PluginBase
{

    public static array $cooldown = [];

    protected function onEnable(): void
    {
        ItemFactory::getInstance()->register(new CobwebItem(TextFormat::colorize("&6Cobweb")), true);
        $this->getServer()->getPluginManager()->registerEvents(new ItemListener($this), $this);
        $this->getServer()->getCommandMap()->register("cobweb", new CobwebCommand("cobweb", "Item-Cobweb Command"));
        $this->getLogger()->info(TextFormat::colorize("&aItem-Cobweb Enable"));
    }

    protected function onDisable(): void
    {
        $this->getLogger()->info(TextFormat::colorize("&cItem-Cobweb Disable"));
    }

}