<?php

namespace Cobweb\listener;

use Cobweb\item\CobwebItem;
use Cobweb\Loader;
use pocketmine\block\BlockFactory;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class ItemListener implements Listener
{

    public Loader $plugin;

    public function __construct(Loader $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onDamage(EntityDamageByEntityEvent $event)
    {
        $player = $event->getDamager();
        $entity = $event->getEntity();
        if ($player instanceof Player and $entity instanceof Player){
            if ($player->getInventory()->getItemInHand() instanceof  CobwebItem) {
                if (!isset(Loader::$cooldown[$player->getName()])) {
                    $block = BlockFactory::getInstance()->get(30, 0);
                    $position = $entity->getPosition();
                    $x = $position->getFloorX();
                    $y = $position->getFloorY();
                    $z = $position->getFloorZ();
                    $world = $entity->getWorld();
                    $world->setBlockAt($x, $y, $z, $block);
                    $world->setBlockAt($x, $y + 1, $z, $block);
                    Loader::$cooldown[$player->getName()] = time() + 40;
                } elseif (time() <= Loader::$cooldown[$player->getName()]) {
                    $reaming = Loader::$cooldown[$player->getName()] - time();
                    $player->sendMessage(TextFormat::colorize("&cCooldown: &4{$reaming}s"));
                } else {
                    unset(Loader::$cooldown[$player->getName()]);
                }
            }
        }
    }

}