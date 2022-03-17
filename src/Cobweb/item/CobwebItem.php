<?php

namespace Cobweb\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\utils\TextFormat;

class CobwebItem extends Item {

    public function __construct(string $name = "Unknown")
    {
        parent::__construct(new ItemIdentifier(ItemIds::BREAD, 0), $name);
        $this->setCustomName($name);
        $this->setLore([TextFormat::colorize("&7Trap Cobweb\n&bCooldown: 40s")]);
    }

}