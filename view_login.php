<?php
$submitted = filter_input(INPUT_POST, 'btnSubmit');
if (isset($submitted)) {
    $userDao = new UserDaoImpl();
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');
    $md5password = md5($password);
    $userLogin = new User();
    $userLogin->setUsername($username);
    $userLogin->setPassword($md5password);
    $registeredUser = $userDao->login($userLogin);
//    $arrResult = login($username, md5($password));
    if (isset($registeredUser) && !empty($registeredUser->name)) {
        $_SESSION['user_login'] = TRUE;
        $_SESSION['name'] = $registeredUser->name;
        header('location:index.php');
    } else {
        $errMsg = 'Invalid username or password';
    }
}

if (isset($errMsg)) {
    echo '<div class="error_msg">' . $errMsg . '</div>';
}
?>

<form method="post">
    <fieldset>
        <legend>Login Form</legend>
        <label for="txtUsernameId">Username</label>
        <input id="txtUsernameId" name="txtUsername" type="text" autofocus="" required="" class="form-input" />
        <label for="txtPasswordId">Password</label>
        <input id="txtPasswordId" name="txtPassword" type="password" required="" class="form-input"/>
        <input name="btnSubmit" type="submit" value="Login" class="button button-default"/>
    </fieldset>
</form>