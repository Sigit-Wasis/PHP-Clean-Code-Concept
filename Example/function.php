<?php

/** 
 * Penggunaan Function di dalam PHP
 * @author : Sigit wasis subekti
*/

/** 
* RULES:
* - Selalu gunakan PHPDOC sebagai function description
* - Nama fungsi minimal adalah 3 kata dengan penulisan camelCase dan harus mendeskripsikan tujuan dari fungsi tersebut
* - Jangan mengulang 2 statement .. tapi buat function untuk statement tersebut
* - Fungsi harus mendeskripsikan tujuan yang jelas dan to the point
* - Pisahkan fungsi jika berbeda tujuan
* - Jangan merubah nilai global variable didalam fungsi
* - Parameter fungsi harus dibawah 2 jangan kebanyakan (Gunakan interface / object jika memungkinkan)
* - Jangan membuat fungsi global tetapi jika terpaksa gunakan pengecekan function_exists() sebelum fungsi
* - Hindari bool flug sebisa mungkin
* - Return secepatnya (cek kemungkinan kesalahan terlebih dahulu)
* - Hapus fungsi yang tidak terpakai (Manfaatkan Git sebagai version control)
* - Pindahkan semua statement didalam anonymous function ke dalam function baru agar bisa reusable
*/


// CONTOH 1:
// Ini memungkinkan terjadinya bug yang susah ditracking dan code jadi susah dimaentenance
// pembulatan bilangan pada angka merupakan fungsi dari round
$base = 10;
$height = 20;
$area_of_triangle = round(($base * $height) / 2);
// ....
// sementara itu, entah diline berapa ataupun file lainnya ditemukan code yang sama persis cuma beda value aja

$base = 15;
$height = 29;
$area_of_triangle = round(($base * $height) /2);

// Sebaiknya jadikan function
function areaOfTriangle(int $base = 0, int $height = 0) : int {
	$area = ($base * $height) / 2;
	return round($area);
}

// sementara itu diline berikutnya dan seterusnya ataupun file lainnya tinggal panggil fungsi tersebut jika dibutuhkan 
$area_of_triangle = areaOfTriangle(base: 10, height:20);



// CONTOH 2:
// Fungsi terlalu banyak statement yang tidak relevan dengan fungsi tersebut
/* Curl adalah sebuah program dan library untuk mengirim dan mengambil data melalui URL*/

function getStudent(int $id) {
	// create curl instance
	$curl = curl_init();
	// set url 
    curl_setopt($ch, CURLOPT_URL, "example.com");
    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output contains the output string 
    $output = curl_exec($curl);
    // tutup curl 
    curl_close($curl);

    // menampilkan hasil output
    $students = json_decode($output);

    foreach ($students as $student) {
    	if ($student->id === $id) {
    		return $student;
    	}
    }

    return null;
}

// Sebaiknya pisah fungsi jadi beberapa bagian. hal ini untuk memungkinkan reusable function nantinya
function getCURL(string $url = '') : string {
	// create curl instance
	$curl = curl_init();
	// set url 
    curl_setopt($curl, CURLOPT_URL, "example.com");
    // return the transfer as a string 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // $output contains the output string 
    $output = curl_exec($curl);
    // tutup curl 
    curl_close($curl);

    return $output;
}

function getTeachers() : array {
	$teachers = getCURL('https://somedomain.com/to/fetch/teachers');
	return json_decode($teachers);
}

function getTeacher(int $id) : object {
	$teachers = getTeachers();
	foreach ($teachers as $teacher) {
		if ($teacher->id === $id) {
			return $teacher;
		}
	}

	// return empty object kalau datanya tidak ditemukan
	return (object)[];
}

// lebih baik lagi kalau dibikin object oriented dengan depedency injection biar nanti kalo unit testing bisa gampang
// Sebuah mekanisme di dalam OOP PHP untuk membuat kontrak
interface CURL_Driver_Interface {
	public function get(string $url = '') : string;
}

class CURL_Driver implements CURL_Driver_Interface {

	public function get(string $url = '') : string 
	{
		// create curl instance
		$curl = curl_init();
		// set url 
	    curl_setopt($curl, CURLOPT_URL, "example.com");
	    // return the transfer as a string 
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    // $output contains the output string 
	    $output = curl_exec($curl);
	    // tutup curl 
	    curl_close($curl);

	    return $output;
	}
}

class CURL_Driver_Test implements CURL_Driver_Interface {
	public function get(string $url = '') : string
	{
		return '[]'; // ceritanya json array of object
	}
}

class Teacher {
	private CURL_Driver_Interface $curl;

	// kita pakai depedency injection
	function __construct(CURL_Driver_Interface $curl)
	{
		$this->curl = $curl;
	}

	public function getAll() : array {
		$teachers = $this->curl->get('https://somedomain.com/to/fetch/teachers');

		return json_decode($teachers);
	}

	public function get($id) : object {
		$teachers = $this->getAll();
		foreach ($teachers as $teacher) {
			if ($teacher->id === $id) {
				return $teacher;
			}
		}

		return (object)[];
	}
}

// Production
$curl = new CURL_Driver();
$teacher = new Teacher($curl);

// Unit testing
$curl = new CURL_Driver_Test();
$teacher = new Teacher($curl);



// CONTOH 3:
// Ini tidak bagus .... karena username bisa aja dirubah dari arah yang tidak diduga duga.
$username = "gaibz";
// void adalah sebuah method dimana method tersebut tidak memiliki nilai kembali sehingga apabila kita memanggil function tersebut ke dalam sebuah program, maka semua script yang ada pada fungsi tersebut dianggap tergabung dalam script diluarnya.
function changeUsername() : void {
	global $username;
	$username = strtoupper($username); 
}

// jangan merubah nilai global variable didalam fungsi
$password = "123456";
function setPassword(string $password = '') {
	return md5($password);
}

$password = setPassword('supersecretPassword123456');