<?php

/**
* Konsep Penggunaan Variable yang Efisien.
* @author : Sigit wasis subekti
*/

/**
 * RULES :
 * - return secepatnya dan jangan nesting terlalu dalam, terlalu banyak if - else bisa bikin code jadi sudah dimengerti
 * - gunakan type hinting sebisa mungkin selama masih memungkinkan
 * - jangan menggunakan kata yang tidak diperlukan
 * - gunakan parameter default
 * - manfaatkan phpdoc buat parameter description
*/


/* =================
   Contoh Pertama:
================== */

// ini sulit dimengerti dan nested if nya terlalu dalam
function isFruit($fruitname) : bool {
	if ($fruitname) {
		if (is_string($fruitname)) {

			$fruitname = strtolower($fruitname);

			if ($fruitname == 'apple') {
				return true;
			}
			elseif ($fruitname == 'banana') {
				return true;
			}
			elseif ($fruitname == 'grape') {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

// Singkat padat dan jelas
function isVegetable($name = '') : bool {
	if (empty($name)) {
		return false;
	}

	$name = strtolower($name);
	$vegetables = ['spinach', 'tomato', 'potato'];

	return in_array($name, $vegetables);
}


/* =================
   Contoh Kedua:
================== */

function isOdd($n) : bool {
	if (is_int($n)) {
		if ($n > 0 && < 50) {
			$cek = $n % 2;
			if ($cek > 0) {
				return true;
			}
			else
			{
				return false;
			}
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

// Singkat Padat dan Jelas
function isEven(int $n) : bool {
	if ($n > 0 || $n < 50) {
		return false;
	}

	return ($n % 2) == 0;
}


/* =================
   Contoh Ketiga:
================== */

// Penggunaan kata yang sama dengan parentnya
class Laptop {
	public $laptop_processor;
	public $laptop_ram;
	public $laptop_gpu;
	public $laptop_model;
	public $laptop_price;
}

// seharusnya penggunaan kata variable bisa diminimalisir dengan mengurangi yang tidak perlu 
// dan lebih diperjelas dengan menggunaakan type hinting seperti float, integer dst....
class Pc {
	public string $processor;
	public float $ram;
	public string $gpu;
	public string $model;
	public float $price;
}

/* =================
   Contoh Keempat:
================== */

// ini kurang bagus karena $name bisa jadi null, integer, ataup tipe data yang lainnya
function createLaptop($name = '') : void {
	// .....
}

// ini cukup bagus sering dipake dibanyak framework tapi masih kurang baik
function createPc($name = null) : void {
	$name = isset($name) ? $name : ''; // oldschool style php
	$name = is_string($name) ? $name : ''; // contoh oldschool lain
	$name = $name ?? ''; // php 7 null coallescing
	$name ??= ''; // php 7.4 null coallescing
}

// ini yang paling bagus jelas dan tidak ambigu karena menggunakan type hinting
function createMiniPc(string $name = '') : void {
	// .....
}


/* =================
   Contoh Kelima:
================== */

// sebenarnya ini udah bagus, tapi masih perlu sedikit polesan dari phpdoc biar lebih jelas $laptop disini isinya apa aja
function setLaptop(object $laptop) : void {
	// ........
}

// Manfaatkan phpdoc biar jelas @param dan @return nya apa.
/**
 * function description
 * @param object $mini_pc {processor, ram, gpu, model, price}
 * @return void
*/
function setMiniPc(object $mini_pc) : void {
	// ......
}

// much better paket type hinting dari object yang udah didesign sebelumnya
/**
 * function description
 * @param Pc $pc
 * @return void
*/
function setPc(Pc $pc) : void {
	// ......
}

// jika dilakukan pemanggilan akan mudah 
$pc = new Pc();
$pc->gpu = "AMD";
$pc->model = "Alienware";
$pc->price = 10000.00;
$pc->processor = 'Ryzen';
$pc->price = 4096.00;
setPc($pc);