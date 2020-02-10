<?php

require 'test_login.php';
require 'test_register.php';
require 'test_show.php';
require 'test_update.php';
require 'test_search.php';
require 'utils.php';

$baseurl =  'https://webdev19.dibris.unige.it/~S4368146/';

echo "[+] Testing Registration - Login - Show Profile\n";

echo "[*] Generating random user\n";

echo "---\n";
$email = generate_random_email();
$pass = generate_random_password();
$first_name = generate_random_name();
$last_name = generate_random_name();
echo "Email: $email\n";
echo "Pass: $pass\n";
echo "First name: $first_name\n";
echo "Last name: $last_name\n";
echo "---\n";



echo "[-] Calling register.php\n";

register($email, $pass, $first_name, $last_name, $baseurl);

echo "[-] Calling login.php\n";
login($email, $pass, $baseurl);

echo "[-] Calling show_profile.php\n";

echo check_correct_user($email, $first_name, $last_name, show_logged_user($baseurl))
    ? "[*] Success!\n"
    : "[*] Failed\n";

echo "------------------------\n";

echo "[+] Testing Update - Show Profile\n";

echo "[*] Generating new random user\n";
$first_name = generate_random_name();
$last_name = generate_random_name();

echo "---\n";
echo "First name: $first_name\n";
echo "Last name: $last_name\n";
echo "---\n";

echo "[-] Calling update_profile.php\n";
update($first_name, $last_name, $baseurl);

echo "[-] Calling show_profile.php\n";

echo check_correct_user($email, $first_name, $last_name, show_logged_user($baseurl))
    ? "[*] Success!\n"
    : "[*] Failed\n";


echo "------------------------\n";

echo "[+] Testing search\n";

echo "[-] Calling search.php - Search: Squadra. \n";
 
$res1=check_search_found("Music",search("Music",$baseurl));

echo "[-] Calling search.php - Search: Band. \n";
 
$res2=check_search_found("Band",search("band",$baseurl));

echo "[-] Calling search.php - Search: Casa. \n";
 
$res3=check_search_found("Squadra",search("Sqadra",$baseurl));

echo ($res1 && $res2 && !$res3)
    ? "[*] Success!\n"
    : "[*] Failed\n";

