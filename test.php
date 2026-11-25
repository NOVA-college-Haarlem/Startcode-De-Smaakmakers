<?php
echo password_hash('Rahaf', PASSWORD_DEFAULT);
echo '<br>';
echo password_hash('Rahaf', PASSWORD_DEFAULT);

$hash = password_hash('Rahaf', PASSWORD_DEFAULT); 

echo '<br>';
echo '<br>';

var_dump(password_verify('Rahaf', $hash));