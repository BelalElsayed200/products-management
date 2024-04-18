
<?php
session_start();
///////////////////////////////
function open_file_products(){
    fopen($_SESSION['user'].'.json', 'a+');
}

function get_data_of_users(){
    $getData = json_decode(file_get_contents('users.json'), true);
    return $getData;
}

function get_data_of_products(){
    $getData = json_decode(file_get_contents($_SESSION['user'].'.json'), true);
    return $getData;
}

function is_space_consecutive($str, $length){
    for($i = 0; $i < $length; $i++){
        if ($str[$i] == ' ' && $str[$i + 1] == ' '){
            return false;
        }
    }
    return true;
}

function check_the_first_three_characters($name){
    $isValid = false;
    for($i = 0; $i < 3; $i++){
        if (!is_numeric($name[$i]) && ctype_alnum($name[$i])){
            $isValid = true;
        }else{
            $isValid = false;
            return $isValid;
        }
    }
    return $isValid;
}

function fullNameValidation($name){
    $isUserNameValid = false;
    $lengthOfName = strlen($name);
    if ($lengthOfName >= 4 && $lengthOfName <= 30 && is_space_consecutive($name, $lengthOfName) && check_the_first_three_characters($name)){
        for($i = 0; $i < $lengthOfName; $i++){
            if (ctype_alnum($name[$i]) || $name[$i] == ' '){
                $isUserNameValid = true;
            }else{
                $isUserNameValid = false;
                return ($isUserNameValid);
            }
        }
    }
    return $isUserNameValid;
}

function email_validation($email){
    $lengthOfEmail = strlen($email);

    if ($lengthOfEmail >= 4 && $lengthOfEmail <= 30 && check_the_first_three_characters($email)){
        return true;
    }
    return false;
}

function passValidation($pass){
    $isPassValid = false;
    if (strlen($pass) >= 12 && strlen($pass) <= 50 && !ctype_alnum($pass)){
        $isPassValid = true;
    }
    return $isPassValid;
}

function isDataRepeat($name, $email, &$id){
    $dataOfJson = file_get_contents('users.json');
    $dataOfJson = json_decode($dataOfJson, true);

    foreach($dataOfJson as $dataJson){
        while($id == $dataJson['id']){
            $id = rand(0, 10000);
        }
        if ($name == $dataJson['fullName'] || $email == $dataJson['emailAddress']){
            return false;
        }
    }
    return true;
}

function is_id_valid($id, $name){
    $products = get_data_of_products();
    foreach($products as $prod){
        if ($prod['id'] == $id || $prod['name'] == $name){
            return false;
        }
    }
    return true;
}

function is_email_valid($email){
    $products = get_data_of_users();
    foreach($products as $prod){
        if ($prod['emailAddress'] == $email){
            return true;
        }
    }
    return false;
}

function addProducts($formData){
    fopen($_SESSION['user'].'.json', 'a+');
    
    $getDataFromJson = get_data_of_products();

    $getDataFromJson[] = $formData;

    file_put_contents($_SESSION['user'].'.json', json_encode($getDataFromJson));


    return true;
}

function updateProducts($id, $name, $quantity, $price){
    $getData = get_data_of_products();
    foreach($getData as &$data){
        if ($id == $data['id']){
            $data['name'] = trim(preg_replace('/\s+/', ' ', $name));
            $data['quantity'] = $quantity;
            $data['price'] = $price;
        }
    }
    file_put_contents($_SESSION['user'].'.json', json_encode($getData));

    header('location: http://localhost/CrudOfProducts/home_page.php');
}

function updateData($name, $email, $pass){
    $old = $_SESSION['user'].'.json';
    $getData = get_data_of_users();
    $newPass = pass_hashing($pass);
    foreach($getData as &$data){
        if ($_SESSION['user'] == $data['fullName']){
            $data['fullName'] = $name;
            $data['emailAddress'] = $email;
            $data['password'] = $newPass;
            $_SESSION['user'] = $name;
        }
    }
    file_put_contents('users.json', json_encode($getData));
    $new = $name.'.json';
    rename($old, $new);

    header('location: http://localhost/CrudOfProducts/home_page.php');
}

function delete_data_of_user($userData, $userProducts){
    foreach($userData as $key => &$data){
        if ($_SESSION['user'] == $data['fullName']){
            unset($userData[$key]);
            unlink($userProducts);
            file_put_contents("users.json", json_encode($userData));
        }
    }
}

function deleteProducts($id, $getData){
    foreach($getData as $key => &$data){
        if ($id == $data['id']){
            unset($getData[$key]);
        }
    }
    file_put_contents($_SESSION['user'].".json", json_encode($getData));

    return true;
}

function pass_hashing($data){
    $option = ['opt' => 12];
    $passHashed = password_hash($data, PASSWORD_BCRYPT, $option);
    return $passHashed;
}

function register(&$formData){
    $getDataFromJson = get_data_of_users();

    $formData['password'] = pass_hashing($formData['password']);

    array_push($getDataFromJson, $formData);

    file_put_contents('users.json', json_encode($getDataFromJson));

    header('Location: http://localhost/CrudOfProducts/login.php');
}

function validate_login($email, $password){
    $existData = false;
    $dataToCheck = file_get_contents('users.json');
    $dataToCheck = json_decode($dataToCheck, true);

    foreach($dataToCheck as $users){
        if ($email == $users['emailAddress'] && password_verify($password, $users['password'])){
            $_SESSION['user'] = $users['fullName'];
            $existData = true;
        }
    }
    return $existData;
}

function reset_password($password){
    $users = get_data_of_users();
    foreach($users as &$user){
        if ($user['emailAddress'] == $_SESSION['user']){
            $passwordHashing = pass_hashing($password);
            $user['password'] = $passwordHashing;
            file_put_contents('users.json', json_encode($users));
            return true;
        }
    }
}

?>

