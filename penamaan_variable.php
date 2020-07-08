<?php

/** Konsep Penamaan Variable yang baik dan benar! **/

/**
	* RULES :
	* = Gunakan nama variable yang jelas dan mudah dipahami.
	* = Gunakan lowercase (huruf kecil) dipisah dengan underscore atau camelCase, tapi lebih baik jika lowercase aja dengan underscore
	* = Gunakan variable tidak lebih dari 3 kata
	* = Gunakan ending s untuk kata yang punya nilai banyak (array)
	* = Reusable (dapat digunakan kembali) variable
	* = Masukkan variable ke dalam object jika memang memiliki parent yang sama
**/

/* =============
   Contoh 1 :
============= */
$n = "Your Name"; // tidak jelas, karena n bisa diartikan sebagai number.
$name = "Your Name"; // jelas dan mudah dipahami


/* =============
   Contoh 2 :
============= */
$ymd = date('Y-m-d'); // tidak jelas 
$current_date = date('Y-m-d'); // jelas dan mudah dipahami


/* =============
   Contoh 3 :
============= */
$string_42 = '42'; // maksudnya string_42 tuh apa? dan kenapa string padahal integer?
$fourty_two_string = '42'; // jelas yaitu 42 sebagai string


/* =============
   Contoh 4 :
============= */
$users = ['wasis']; // misalkan banyak data

/* render di view */
foreach ($users as $k => $v) {
	# $v tidak jelas dan $k, index kah?
	echo $v;
}

// bagus dengan seperti ini
foreach ($users as $key => $user) {
	# $user jelas maksudnya adalah single user, dan $key adalah key dari array .. jelas dan mudah dipahami
	echo $user;
}

// jauh lebih baik untuk pengulangan array
array_walk($users, function($user, $key))
{
	// lebih baik karena variable $user dan $key ada dalam scope dan tidak bisa diakses diluar function
	echo $user;
}


/* =============
   PENGECUALIAN 
============= */

// Penyingkatan variable boleh dilakukan didalam scope jika scope itu tidak besar dan hanya untuk indexing angka

/* =============
   CONTOH 
============= */
for ($i=0; $i < 10; $i++) { 
	# $i disini cuma sebagai index didalam scope, dan mudah diartikan kalau $i itu singkatan dari $index
	echo $i;
}

// Tetapi akan lebih baik jika
for ($index=0; $index < 10; $index++) { 
	// $index disin jelas bahwa maksudnya adalah index
	echo $index;
}


/* =============
   Contoh 5 : 
============= */
$first_name = 'Sigit';
$last_name = "wasis subekti";

$full_name = "Sigit wasis subekti"; // Bad, not reausable variable

$full_name = $first_name." ".$last_name; // Good ... reausable variable

$full_name = implode(" ", [$first_name, $last_name]); // just another example

// bad, karena jadi tidak reausable
// karena jika json a akan digunakan lagi pasti buat json_decode kembali
if (json_decode('{"a":"a"}')->a == "a") {
	echo true;
}

// Good, dibikin jadi reausable variable dulu
$json = json_decode('{"a":"a"}');
if ($json->a == "a") {
	echo true;
}


/* =============
   Contoh 6 : 
============= */
// Bad(buruk), karena jadi banyak nama variable padahal tujuannya adalah membuat user
$user_info = "info";
$user_data = "data";
$user_name = "name";

// Bagus, tapi masih kurang benar karena array harusnya sebagai kumpulan data bukan sebagai object
$user = [
	'info'	=> 'info',
	'data'	=> 'data',
	'name'	=> 'sigit'
];

// Good, disatukan jadi object
// stdClass adalah kelas kosong generik PHP, semacam Objek di Java atau objek dengan Python
$user = new stdClass();
$user->info = "info";
$user->data = "data";
$user->name = "sigit";


/* =============
   Contoh 7 : 
============= */
// Ceritannya ada fungsi seperti ini
function saveUser($name, $country) {
	return $name." ".$country;
}

// Just in case punya variable yang harusnya object tapi mesti dibikin array

$user = ['Sigit', 'Indonesia']; // buruk, karena nanti panggilannya harus $user[0], $user[1] dst.....
saveUser($user[0], $user[1]); //sulit dipahami maksudnya 0 dan 1 apa

// Bagus(good), karena nanti panggilannya jelas $user['name'], $user['country']
$user = [
	'name'		=> 'Sigit',
	'country'	=> 'Indonesia'
];
saveUser($user['name'], $user['country']);

// Better(lebih baik), compile dulu jadi object, biar pemanggilan selanjutnya adalah object
$user = (object)$user;
saveUser($user->name, $user->country);


/* =============
   Contoh 8 : 
============= */
// gunakan nilai yang mudah dipahami
$json = json_encode($user, 16 | 32 | 2); // Buruk(bad), maksudnya 16 32 2 itu apa?

// parameter JSON_FORCE_OBJECT berfungsi agar array key tetap “utuh” dalam format JSON.
// parameter JSON_NUMERIC_CHECK supaya format json dalam angka
// parameter JSON_HEX_AMP mengubah ( & ) menjadi \u0026
$json = json_encode($user, JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_HEX_AMP); // Bagus akan mudah dimengerti maksudnya


/* =============
   Contoh 9 : 
============= */
// Buruk
class UserBad {
	// tidak jelas maksudnya 1 itu apa ??
	public $roles = 1;
}

$user =	new UserBad();
// maksudnya 3 itu apa??
if ($user->roles == 3) {
	return false;
}

// ini buat apa lagi??
$user->roles = 2;

// Good
class UserGood {
	public const ROLE_ADMIN = 1;
	public const ROLE_USER = 2;
	public const ROLE_GUEST = 3;

	public $roles = self::ROLE_ADMIN; // Secara default rolenya adalah admin, dan ini jelas
}

$user = new UserGood();

// Jelas ngecek kalo role ini guest atau bukan
if ($user->roles == UserGood::ROLE_GUEST) {
	return false;
}

$user->roles = UserGood::ROLE_USER; // jelas kalo ini dibikin jadi role user...