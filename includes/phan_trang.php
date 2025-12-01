<?php
    include('../includes/db_connect.php');
    Class Phan_trang
    {
        private $rowsPerPage;
        public function __construct($rowsPerPage)
        {
            $this->rowsPerPage = $rowsPerPage;
        }
        public function getRowsPerPage(){
            return $this->rowsPerPage;
        }
        public function getLimitPage(){
            if(!isset($_GET['page']))
            {
                $_GET['page']=1;
            }
            $offset = ($_GET['page']-1)*$this->rowsPerPage;
            return $offset.",".$this->rowsPerPage;
        }
        public function paging($sql_query)
        {
           
            $numRows = mysqli_num_rows($sql_query);
             //tổng số trang
                        $maxPage = floor($numRows/$this->rowsPerPage) + 1;                
                        if(!isset($_GET['page']))
                        {
                            $_GET['page']=1;
                        }
                        //tạo link tương ứng tới các trang
                        echo "<div style='text-align:center; margin-top:10px;'>";
                        if($_GET['page'] > 1)
                        {
                            echo "<a href=" .$_SERVER['PHP_SELF']."?page=1><<</a> ";
                            echo "<a href=" .$_SERVER['PHP_SELF']."?page=".($_GET['page']-1)."><</a> ";           
                        }           
                        for ($i=1 ; $i<=$maxPage ; $i++)
                        { if ($i == $_GET['page'])
                        { echo "<b>$i</b> "; //trang hiện tại sẽ được bôi đậm
                        }
                        else
                            echo "<a href=" .$_SERVER['PHP_SELF']. "?page=".$i.">$i</a> ";
                        }
                        if($_GET['page'] < $maxPage)	
                        {
                            echo "<a href=". $_SERVER['PHP_SELF']."?page=".($_GET['page']+1).">></a> ";
                            echo "<a href=". $_SERVER['PHP_SELF']."?page=$maxPage>>></a> ";
                        }
                        echo "</div>";
        }
    }
?>