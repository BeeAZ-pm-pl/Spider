<?php

namespace Spider;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\command\{Command, CommandSender};
use Spider\libs\jojoe77777\FormAPI\SimpleForm;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener{
  
  public function onEnable(): void{
   $this->getServer()->getPluginManager()->registerEvents($this, $this);
   $this->saveDefaultConfig();
  }
  public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args): bool{
  switch($cmd->getName()){
    case "spider":
   if(!$sender instanceof Player){
     $sender->sendMessage("Please Use Command In Game");
     return true;
   }
   if($sender->hasPermission("spider.command")){
     $this->menu($sender);
     break;
   }
  }
  return true;
  }
  public function menu($sender){
  $form = new SimpleForm(function(Player $sender, $data){
  if($data === null){
  return true;
  }
  switch($data){
    case 0:
    $sender->setCanClimbWalls(true);
    $sender->sendMessage($this->getConfig()->get("message-on"));
    break;
    case 1:
    $sender->setCanClimbWalls(false);
    $sender->sendMessage($this->getConfig()->get("message-off"));
    break;
  }
  });
  $form->setTitle($this->getConfig()->get("title"));
  $form->setContent($this->getConfig()->get("content"));
  $form->addButton($this->getConfig()->get("button1"));
  $form->addButton($this->getConfig()->get("button2"));
  $form->sendToPlayer($sender);
  }
}
