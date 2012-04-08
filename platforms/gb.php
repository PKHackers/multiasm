<?php
class platform extends platform_base {
	private $details;
	const extension = 'gb';
	
	function __construct() {
		$this->details['InitVector'] = sprintf('%04X', rom::get()->getShort(0x102));
		$this->details['InternalTitle'] = rom::get()->read(15,$this->map_rom(0x134));
	}
	public function map_rom($offset) {
		if (($offset&0xFFFF) >= 0x8000)
			throw new Exception('Not ROM');
		else if (($offset&0xFFFF) < 0x4000)
			return $offset&0xFFFF;
		else
			return ($offset&0xFFFF) + (($offset>>16)*0x4000);
	}
	public function getMiscInfo() {
		return $this->details;
	}
}
?>