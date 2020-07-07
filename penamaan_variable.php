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

// Contoh 1 :
$n = "Your Name"; // tidak jelas, karena n bisa diartikan sebagai number.
$name = "Your Name"; // jelas dan mudah dipahami

// Contoh 2 : 
$ymd = date('Y-m-d'); // tidak jelas 
$current_date = date('Y-m-d'); // jelas dan mudah dipahami

// Contoh 3 :
$string_42 = '42'; // maksudnya string_42 tuh apa? dan kenapa string padahal integer?
$fourty_two_string = '42'; // jelas yaitu 42 sebagai string

// Contoh 4 :
$users = ['wasis']; // misalkan banyak data

/* render di view */
foreach ($users as $k => $v) {
	# $v tidak jelas dan $k tidak index kah?
	echo $v;
}

foreach ($users as $key => $user) {
	# $user jelas maksudnya adalah single user, dan $key adalah key dari array .. jelas dan mudah dipahami
	echo $user;
}

// jauh lebih baik untuk pengulangan array
array_walk($users, function($user, $key))
{
	// lebih baik karena variable $user dan $key ada dalam score dan tidak bisa diakses diluar function
	echo $user;
}

/** PENGECUALIAN **/

// Penyingkatan variable boleh dilakukan didalam scope jika scope itu tidak besar dan hanya untuk indexing angka
// Contoh 1 :
for ($i=0; $i < 10; $i++) { 
	# $i disini cuma sebagai index didalam scope, dan mudah diartikan kalai $i itu singkatan dari $index
	echo $i;
}

// Tetapi akan lebih baik jika
for ($index=0; $index < 10; $index++) { 
	// $index disin jelas bahwa maksudnya adalah index
	echo $index;
}

// Contoh 5 :
$first_name = 'Sigit';
$last_name = "wasis subekti";

$full_name = "Sigit wasis subekti"; // Bad, not reausable variable

$full_name = $first_name." ".$last_name; // Good ... reausable variable

$full_name = implode(" ", [$first_name, $last_name]); // just another example