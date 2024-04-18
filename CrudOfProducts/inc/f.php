<?php
// pass_hash
// $pass = 'pwd123';
// $salt = bin2hex(random_bytes(16));
// echo '1 => '.$salt;
// echo "\n";
// $hash = $salt.$pass;
// $dataToHash = hash("sha256", $hash);

// echo '2 => '.$dataToHash;

// $new = $pass;
// $newSalt  = $salt;
// $hash = $newSalt.$new;
// $dataToHash2 = hash("sha256", $hash);

// if ($dataToHash == $dataToHash2){
//   echo "\nyes, the same";
// }else{
//   echo "\nnot, the same";
// }
// function check($string){
//   $lengthOfString = strlen($string);
//   for($i = 0; $i < $lengthOfString - 1; $i++){
//     if ($string[$i] == ' ' && $string[$i + 1] == ' '){
//       echo 'false';
//     }
//   }
// }

// $str = "b l  a l";

// check($str);



// $to = "belalelsayed200@gmail.com";
// $subject = "My subject";
// $txt = "Hello world!";
// $headers = "From: VS.Code@gm.com" . "\r\n" .
// "CC: somebodyelse@example.com";

// mail($to,$subject,$txt,$headers);

// session_start();
// if (true){
// $name = 'belal';
// $_SESSION['user'] = $name;
// $_SESSION['useruser'] = $name.'n';
// header('location: http://localhost/CrudOfProducts/inc/q.php');
// }

// $v = '13';

// var_dump(!is_numeric($v));

// $option = ['opt' => 12];

// $ph = password_hash($v, PASSWORD_BCRYPT, $option);

// // $ph = '$2y$10$UGNO7QWHlaWlDiuG.Vmaz.yPgnJQci7p3JZGLTFUu7K1qotL3Gq/q';

// var_dump( password_verify($v, $ph));

$v = ('         belal          elsayed  ');

$c = ( substr_count($v, ' '));

echo $v;
echo "\n".trim(preg_replace('/\s+/', ' ', $v))."\n";
echo substr_count($v, " ");










?>