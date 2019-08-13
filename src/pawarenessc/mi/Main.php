<?php

namespace pawarenessc\mi;

use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\item\Item;

class Main extends pluginBase implements Listener{

	public function onEnable(){
		$this->getLogger()->info("=========================");
		$this->getLogger()->info("MoreInvを読み込みました");
		$this->getLogger()->info("製作者 PawarenessC");
		$this->getLogger()->info("0.1");
		$this->getLogger()->info("=========================");
		$this->players = new Config($this->getDataFolder()."Players.yml", Config::YAML);
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) :bool{
		$name = $sender->getName();
		if(!$this->players->exists($name)){
			$inv = $sender->getInventory->getContents();
			$this->players->set($name,$inv);
			$this->players->save();
			$sender->getInventory()->clearAll();
		}else{
			$invv = $this->players->get($name);
			$sender->getInventory->setContents($invv);
			$this->players->remove($name);
			$this->players->save();
			$inv = $sender->getInventory->getContents();
			$this->players->set($name,$inv);
			$this->players->save();
		}
	}
}
