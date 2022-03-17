<?php

namespace Cobweb\command;

use Cobweb\item\CobwebItem;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class CobwebCommand extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if (Server::getInstance()->isOp($sender->getName())){
                $item = new CobwebItem(TextFormat::colorize("&6Cobweb"));
                $sender->getInventory()->addItem($item);
                $sender->sendMessage(TextFormat::colorize("&6Cobweb &7x1"));
            }else{
                $sender->sendMessage(TextFormat::colorize("&cNot Permissions"));
            }
        }
    }

}