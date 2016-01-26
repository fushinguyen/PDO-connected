# PDO-connected
All function use array(key=>value).
Example to use insertDB():
$conn = new PdoDB($servername, $dbname, $username, $password);
ss1: $arg = array( 'username' => 'monkey',
              'password' => '123456',
              'email' => 'deamonkey@gmail.com');
    $conn->insertDB($tblname, $arg); //$tblname is table in database
                                    //$arg contain fields of $tblname and value that will be inserted into database.
ss2 $conn->insertDB($tblname, ['username' => 'monkey',
              'password' => '123456',
              'email' => 'deamonkey@gmail.com']);
