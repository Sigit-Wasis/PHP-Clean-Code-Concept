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