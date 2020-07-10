<?php

/** 
 * Control Structure yang mudah dipahami
 * @author : Sigit wasis subekti
*/

/**
 * - Gunakan identical operator (== dari pada =)
 * - Logic harus simple dan se-efesien mungkin
 * - Gunakan ? (question mark) dibanding if jika memang value nya sederhana
 * - Gunakan switch untuk nilai yang sudah diketahui dan gunakan if untuk expression
 * - Hindari nested terlalu dalam
 * - Lanjutkan looping secepatnya jika nilai tidak sesuai
 * - Keluar dari looping secepatnya jika nilai sudah didapatkan
*/


// CONTOH 1 :
// Ini bisa disederhakan dan di sempurnakan
$number = 1; 
$number_type = "";
if ($number == 0) {
	$number_type = "neutral";
}
elseif ($number > 0) {
	$number_type = "positive";
}
else {
	$number_type = "negative";
}

// Sedikit lebih sederhana tapi kurang bagus
$number = 0;
$number_type = "";
if ($number === 0) $number_type = "neutral";
else if ($number > 0) $number_type = "positive";
else $number_type = "negative";

// kalau masih bisa dalam 1 baris kenapa harus banyak2 ??
// ternary operator
$number = 1;
$number_type = $number === 0 ? "neutral" : ($number > 0 ? "positive" : "negative");



// CONTOH 2 (pengecekan dua kondisi):
// kurang bagus dan tidak indah dipandang
function getTitleBad(int $age = 0, string $gender="") : string {
	$genders = ["male", "female"];

	
}