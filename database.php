<?php

class database {

    private $host_name;       // 服务器名
    private $database_user;   // mysql 用户名  	
    private $database_passwd; // mysql 密码
    private $database_name;   // 数据库名
    public $table_user;
    public $table_timu;
    public $table_answer;
    private $unicode;  // 编码格式

    function __construct($host_name, $database_user, $database_passwd, $database_name, $unicode) {

        $this->host_name = $host_name;
        $this->database_user = $database_user;
        $this->database_passwd = $database_passwd;
        $this->database_name = $database_name;

        $this->unicode = $unicode;

        $this->Connect();
    }

    function Connect() {
        $link = mysql_connect($this->hostname, $this->database_user, $this->database_passwd) or die("Failed" . mysql_error());
        mysql_select_db($this->database_name, $link) or die("No exist" . $this->database_name);
        $this->Query("SET NAMES '$this->unicode'");
    }

    function Query($sql) {
        return mysql_query($sql);
    }

    function Fetch_array($result) {
        return mysql_fetch_array($result);
    }

    function Num_rows($result) {
        return mysql_num_rows($result);
    }

//====================================

    function Fn_Insert($table_name, $table_head, $table_value) {
        $this->Query(" INSERT INTO $table_name($table_head) VALUES ($table_value) ");
    }

    /* function Fn_Update($table_name,$table_head,$table_value) {
      $this->Query(" UPDATE $table_name SET Address = 'Zhongshan 23', City = 'Nanjing' WHERE LastName = 'Wilson' ")
      } */

    function Fn_Select_Table($table_name) {
        return $this->Query(" SELECT * FROM $table_name WHERE user_name='ycsxxp' ");
    }

    function Fn_List($table_name) {
        $result = $this->Query(" SELECT * FROM $table_name ");
        while ($row = $this->Fetch_array($result)) {
            print_r($row);
        }
    }

}

$db = new database('localhost', 'root', 'cl30CL', 'loginsystem', 'utf8');
?>
