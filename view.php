<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Validare CNP</title>
</head>
<body>
<div id="box">
    <form>
        <input type="text" maxlength="13" title="Introduceti CNP" name="cnp" id="cnp" /> <!--atribute input box-->
        <input type="submit" value="Verifica CNP"/>
    </form>
    <?php

    if (isset($_GET['cnp']))
    {
        include 'class/validatorcnp.class.php';

        $user = new cnp($_GET['cnp']);
        if($user->KeyCheck()){ //ruleaza algoritmul de verificare 
			echo "<b>CNP introdus: ".$_GET['cnp']. "<br />"; //intoarce input
			echo "<b>CNP valid! </b>". "<br />"; // rezultat
            echo "<b>Sex: </b>".$user->getSex(). "<br />";//intoarce sexul :D
            echo "<b>Varsta: </b>".$user->getAge(). "<br />";//intoarce varsta
			echo "<b>Data nasterii: </b>".$user->getDay().'.'.$user->getMonth().'.'.$user->getYear() ."<br />"; //intoarca data nasterii
            echo "<b>Locul nasterii: </b>".$user->getCity(). "<br />"; //intoarce locul nasterii
			die;
        } else // sau nu
			echo "<b>CNP introdus: ".$_GET['cnp']. "<br />"; 
			echo "CNP invalid!"; 
			die;
    }
	
    ?>
</div>
</body>
</html>

