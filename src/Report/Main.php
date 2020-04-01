<?php
namespace Report;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use jojoe7777\FormAPI;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as CP;

class Main extends PluginBase{
	public $tag = "";
	public $config;
	
	public function onEnable(){
		$this->getServer()->getLogger()->info("online");
		
		$this->ratefile = new Config($this->getDataFolder(). "Rating.yml", Config::YAML);
	}
	
	public function onLoad(): void{
		$this->getServer()->getLogger()->notice("Loading.....");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
		if(!($sender instanceof Player)){
				$this->getLogger()->notice("Please Dont Use that command in here.");
				return false;
			}
		switch($cmd->getName()){
			case "report":
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createCustomForm(Function (Player $s, $data){
			switch($data[0]){
				case 0:
				$rate = "ให้เพิ่มระบบ";

				break;
				case 1:
				$rate = "ให้เพิ่มความสามารถยส";
	
				break;
				case 2:
				$rate = "ให้เพิ่มยสใหม่";
				
				break;
				case 3:
				$rate = "ให้เพิ่มไอเท็มใหม่";
				
				break;
				case 4:
				$rate = "ให้เพิ่มของซื้อ-ขาย";
				
				break;
			}
			
			$this->getServer()->getLogger()->notice("Có bạn  ".$s->getName().", RATE Rating.yml");
			$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
				$form = $api->createCustomForm(Function (Player $player, $data){
				});
				
			$form->setTitle("สลิป");
			$form->addLabel("§c→ §bระบบใด้ส่งข้อความไปแล้วกุณารอแอดมินตรวจสอบภายใน 24 ซม.");
			$form->sendToPlayer($s);
			
			$this->ratefile->set($s->getName(), ["Rating" => $rate, "ลายละเอียด" => $data[1]]);
			$this->ratefile->save();
		});
		$form->setTitle("letter");
		$form->addDropdown("หากปั่นระบบจะแบนทันที\n\n§c→ §bเกี่ยวกับ", ["ให้เพิ่มระบบ", "ให้เพิ่มความสามารถยส", "ให้เพิ่มยสใหม่", "ให้เพิ่มไอเท็มใหม่", "ให้เพิ่มของซื้อ-ขาย"]);
		$form->addInput("§c→ §bใส่ข้อความ", "sms");
		$form->sendToPlayer($sender);
		return true;
	}
	}
}