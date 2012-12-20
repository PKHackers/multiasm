<?php
class cpuFactory {
	private static $cpus = array();
	private function _construct() { }
	public static function getCPU($name) {
		$name = strtolower($name);
		$subcpu = '';
		switch ($name) {
			case '65c816':
			case '65816':
				$cpu = '65816';
				break;
			case '6502':
				$cpu = '6502';
				break;
			case 'z80g':
				$subcpu = 'z80g';
			case 'z80':
				$cpu = 'z80';
				break;
			case 'arm':
				$cpu = 'ARM';
				break;
			case 'spc700':
				$cpu = 'SPC-700';
				break;
			default:
				throw new Exception('Unrecognized CPU!');
		
		}
		require_once 'cpus/'.$cpu.'.php';
		$name = 'cpu_'.$cpu;
		if (!isset(self::$cpus[$name])) {
			debugmessage('Getting new CPU...'.$name, 'info');
			self::$cpus[$name] = new $name($subcpu);
		}
		return self::$cpus[$name];
	}
}
?>