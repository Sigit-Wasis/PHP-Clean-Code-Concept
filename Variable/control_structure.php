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

	// in_array adalah fungsi yang digunakan untuk pengecekan nilai yang ada dalam sebuah array
	if (in_array($gender, $genders)) {
		if ($age > 20) {
			if ($gender === "male") {
				return "mister";
			} else if ($gender === "female") {
				return "madam";
			} else {
				return "";
			}
		} else {
			if ($age > 0) {
				if ($gender === "male") {
					return "Boy";
				} else if ($gender === "female") {
					return "Girl";
				} else {
					return "";
				}
			} else {
				return "";
			}
		}
	} else {
		return "";
	}
}


// Good .. gampang dipahami dan enak dipandang
function getTitle (int $age = 0, string $gender = "") : string {
	$genders = ['male', 'female'];

	// cek jika isi array tidak sesuai dengan yang ada pada $genders atau umur lebih kecil sama 0 maka kosong 
	if (!in_array($gender, $genders) || $age <= 0) {
		return ""; // return secepatnya jika data tidak sesuai
	}

	$is_male = ($gender === "male");

	// gunakan ? dibanding if jika memang sederhana
	return $age > 20 ?
		($is_male ? "Mister" : "Madam") :
		($is_male ? "Boy" : "Girl");
}


// CONTOH 3 (Logic didalam looping)
// Initialization
$cars = ['', 'Avanza', 'Xenia', 'Mobilio', 'Ertiga'];

// bad atau buruk
foreach ($cars as $car) {
	if (!empty($car)) {
		if ($car === "Avanza") {
			echo "Toyota";
		} else if ($car === "Xenia") {
			echo "Daihatsu";
		} else if ($car === "Mobilio") {
			echo "Honda";
		} else {
			echo "Suzuki";
		}
	}
}