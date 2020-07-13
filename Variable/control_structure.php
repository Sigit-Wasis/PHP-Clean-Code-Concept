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

// Good
foreach ($cars as $car) {
    if(empty($car)) continue; // Lanjutkan secepatnya jika data tidak sesuai

    if($car === "Avanza") echo 'Toyota';
    else if($car === "Xenia") echo 'Daihatsu';
    else if($car === "Mobilio") echo 'Honda';
    else ($car === "Ertiga") echo 'Suzuki';
}



// Contoh Lain
// Ceritanya ini mau nyari nilai yang sama dan apabila udah ketemu berhenti

// Bad tidak enak dilihat
$found = false;
foreach ($cars as $key => $car) {
	if ($found === false) {
		if ($car === 'Avanza') {
			// Membuat Baris Baru Lintas Platform Dengan PHP
			echo "found in key : ".$key.PHP_EOL;
			$found = true;
		}
	}
	// looping tetap berjalan meskipun nilai found nya dirubah jadi true code blocking tetap berjalan
}

// Good simple dan enak dilihat
// Jadi jika di dalam $cars ada value Xenia maka langsung tampilkan jika tidak ada break berhenti pengecekan
foreach ($cars as $key => $car) {
	if ($car === 'Xenia') {
		echo "Found in key : ".$key;
		break; // keluar looping secepatnya jika nilai sudah didapatkan 
 	}
}



// TAMBAHAN (IF VS SWITCH)
// Kapan menggunakan Switch dan Kapan menggunakan IF ELSE
/* Jika If digunakan pada saat membutuhkan ekspresi atau operasi seperti ||, >, <, <= dll
   Sedangkan Switch dinyatakan dalam bilangan bulat atau karakter */
// NOTE: Switch hanya variable yang nilai nya sudah diketahui dan tidak membutuhhkan expresi

// If akan melebar ke samping
$car = "Avanza";
if ($car === "Xenia" || $car === "Avanza" || $car === "Fortuner") {
	$vendor = "Toyota";
} 
else if($car === "Jazz" || $car === "Mobilio" || $car === "CRV" ) {
	$vendor = "Honda";
}
// Terkadang ada yang membuat seperti ini ke bawah namun tidak enak untuk dilihat
else if (
	$car === "Ertiga" ||
	$car === "Karimun" ||
	$car === "Jimny"
) {
	$vendor = "Suzuki";
}
else {
	$vendor = "";
}

$bike = "Vario";
// Switch bisan di grouping ke bawah dibanding if yang menyamping
switch ($bike) {
	case 'Mio':
	case 'Nmax':
	case 'Xmax':
		$vendor = "Yamaha";
		break;

	case 'Beat':
	case 'Vario':
	case 'PCX':
		$vendor = "Honda";
		break;
	
	default:
		$vendor = "";
		break; // opsional untuk break terakhir pada switch
}


// TAMBAHAN (FOR VS WHILE)
// for hanya untuk nilai yang sudak diketahui
for ($index=0; $index <= 1000; $index++) { 
	// do some work
	// .....
	// .....
	// .....
	echo $index;
}

// while untuk nilai yang belum diketahui
$run = true;
while($run) {
	// do some work
	// .....
	// .....
	// Jika work sudah selesai nonaktikan loop
	$run false;
}

// Atau dapat menggunakan seperti ini
while (true) {
	continue;
	break;
}

// -==================================
// PERBEDAAN ANTARA FOREACH DENGAN FOR
// -==================================

/* Secara sederhana foreach merupakan salah satu dari build in function untuk looping yang sangat berguna untuk mempersingkat kodingan. Kalau for sendiri merupakan perulangan dan bukan build in function sama seperti while. Jika anda ingin mempersingkat kodingan. Maka gunakanlah foreach. Jika anda ingin memperpanjang kodingan dan terlihat lebih banyak barisan kodingan, maka gunakan for. */