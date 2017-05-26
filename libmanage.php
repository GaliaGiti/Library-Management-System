




<?php 
mysql_connect("127.0.0.1", "root", "") or die("Connection not possible!");

mysql_select_db("libmanagedb") or die("no database found!");
?>


<h2>Library Management System </h2>
(Galia Rabbani, Mou Akter, Shanto Rahman)
<hr>


<br><br>
<br><br>

<h3>Search Books </h3>
<hr>


<form action="libmanage02.php"  method="post">
	<input type="text" name="searchedWriterName" placeholder="Search by writer's name..">
	<input type="submit" name="searchWriterButton" value="Search!" >

</form>


<?php
	if (isset($_POST['searchWriterButton'])) 
	{
		if (    $_POST['searchedWriterName']  == ""  ) 
		{
			echo "Please write at least something.. ";
		}

		else
		{
			$lekhok =   $_POST['searchedWriterName']; 
			$searchedBook =  mysql_query("SELECT * FROM booktable WHERE writerName LIKE '%$lekhok%' ");

			while ($row =  mysql_fetch_assoc($searchedBook)) 
			{
				echo $row['bookName'] .",  " . $row['writerName']."<br>";
			}
		}
	}
?>


<br><br>



<form action="libmanage02.php"  method="post">
	<input type="text" name="searchedBookName" placeholder="Search by books's name..">
	<input type="submit" name="searchBookButton" value="Search!" >

</form>


<?php



	if (isset($_POST['searchBookButton'])) 
	{


			if (    $_POST['searchedBookName']  == ""  ) 
			{
				echo "Please write at least something.. ";
			}

			else
			{
				$boi =   $_POST['searchedBookName']; 

				$searchedBook =  mysql_query("SELECT * FROM booktable WHERE bookName LIKE '%$boi%' ");


				while ($row =  mysql_fetch_assoc($searchedBook)) 
				{
					echo $row['bookName'] .",  " . $row['writerName']."<br>";
				}


			}



	}


?>



<br><br><br><br>
<h3> Registration Section </h3>
<hr>
<form action="libmanage02.php" method="post">
	
	<input type="text" name="inputName" placeholder="Enter your name..">
	<input type="text" name="inputJob" placeholder="Occupation..">

	<input type="submit" name="registerButton" value="Register!">
</form>


<?php 

if(isset($_POST['registerButton'])){


	$naam = $_POST['inputName'];
	$pesha = $_POST['inputJob'];

	mysql_query("INSERT into  manushtable (manushName, manushJob) VALUES ('$naam', '$pesha') ");


}



?>



<br><br>
<h3> Borrowing Section </h3>
 <hr>

<form action="libmanage02.php" method="post"> 
	<input type="number" name="BorrowingStudentId" placeholder="Your ID?">
	<input type="number" name="BorrowingBookId" placeholder="Which Book?">
	<input type="submit" name="borrowButton" value="Borrow now!">

</form>

<?php
	
	if (isset($_POST['borrowButton'])) {
		
		$jeDharNicche = $_POST['BorrowingStudentId'];
		$jeBoi = 	$_POST['BorrowingBookId'];

		mysql_query("UPDATE manushtable SET borrowedBookID = '$jeBoi' WHERE  manushID =  '$jeDharNicche' ");

		mysql_query(" UPDATE booktable SET isBorrowed = '1' WHERE bookID = '$jeBoi' ");


	}
?>


<br><br>
<h3>Returning Section  </h3>
 <hr>

<form action="libmanage02.php" method="post">

<input type="number" name="returningBookID" placeholder="Enter BookID..">

<input type="number" name="returningStudentID" placeholder="Your ID..">
<input type="submit" name="returningButton" value="Return Now!">
	


</form>

<?php 

if (isset($_POST['returningButton'])) {

	$jeFerot = $_POST['returningStudentID'];

	$jaFerot = $_POST['returningBookID'];



	mysql_query(" UPDATE  manushtable SET borrowedBookID = '0' WHERE manushID = '$jeFerot' ");

	mysql_query("UPDATE booktable Set isBorrowed = '0' WHERE bookID = '$jaFerot' ");

}


?>

<br><br>



<h3> Database Section  </h3>
(PeopleId - Name - BorrowedBookID)
<hr>

<?php
	
	$manushTableSQL =  mysql_query(" SELECT * from   manushtable ");


	while ($row = mysql_fetch_assoc($manushTableSQL)) {
		echo $row['manushID'] . ". " . $row['manushName'] . ", " .$row['borrowedBookID'] ."<br>";
	}



?>



<br><br>
<h2>Books</h2> 
(BookID - Name - Writer - IsBorrowed?)
<hr>


<?php

$bookData = mysql_query("SELECT * FROM booktable ");





while ($row = mysql_fetch_assoc($bookData)) {
	
	echo $row['bookID'] . ". " . $row['bookName'] . ", " .  $row['writerName'] . ", " . $row['isBorrowed'] . " <br>" ; 

}



 ?>
































