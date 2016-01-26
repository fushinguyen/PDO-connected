<?php
/**
 *    All function use array(key=>value);
 */
class PdoDB
{
  protected $conn;
  public $servername;
  public $username;
  public $password;
  public $dbname;

  function __construct($servername, $dbname, $username, $password)
  {
    $this->servername = $servername;
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $password;

    try {
          $this->conn = new PDO("mysql:host=$this->servername; dbname=$this->dbname", $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
    } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
    }
  }
  //insert data not time
  public function insertDB($tblname, $arg){
    if (isset($this->conn)) {
        //key
        $fields=array_keys($arg);
        $fieldlist=implode(',',$fields);

        //value
        $values=array_values($arg);
        $valuelist=implode(',',$values);

        //query
        $qs=str_repeat("?,",count($fields)-1);
        $sql="insert into $tblname($fieldlist) values(${qs}?)";
        echo "<br/>".$sql;
        try {
              $stmt = $this->conn->prepare($sql);
              $stmt->execute($values);
              echo "New record created successfully";
        } catch (PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
        }

    }else {
        echo "Bạn chưa kết nối tới dữ liệu. Vui lòng thử lại sau!";
    }
  }

  public function updateDB($tblname, $setArg, $whereArg){
    if (isset($this->conn)) {
        try {
              $upval = [array_values($setArg)[0], array_values($whereArg)[0]];
              $swVal = [array_keys($setArg)[0], array_keys($whereArg)[0]];
              $sql="UPDATE $tblname SET $swVal[0]=? WHERE $swVal[1]=?";

              $stmt = $this->conn->prepare($sql);
              $stmt->execute($upval);
              echo "<br/>Đã cập nhật ".$stmt->rowCount()." dòng.<br/>";

        } catch (PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
        }

    }else {
      echo "Bạn chưa kết nối tới dữ liệu. Vui lòng thử lại sau!";
    }

  }

//delete single-table
  public function deleteDB($tblname, $arg){
    if (isset($this->conn)) {
        try {
          $whereArg = [array_keys($arg)[0], array_values($arg)[0]];
          $sql="DELETE FROM $tblname WHERE $whereArg[0]='$whereArg[1]'";
          echo "<br/>".$sql;
          echo "<br/>".$whereArg[1]."<br/>";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          echo "<br/>Đã xoá ".$stmt->rowCount()." dòng.<br/>";

        } catch (PDOException $e) {
              echo $sql . "<br>" . $e->getMessage();
        }

    }else {
      echo "Bạn chưa kết nối tới dữ liệu. Vui lòng thử lại sau!";
    }

  }

}
 ?>
