<?php 

//initialize DB connection
	$servername = "supplyaidhost";
	$username = "root";
	$password = "";
	$databaseName = "supplyaid_contact";

//Create connection
	$conn = new mysqli($servername, $username, $password, $databaseName);

//Check connection
	if($conn->connect_error){
		die("ERROR: Could not make connection." . $conn->connect_error);
	}

//testing retrieving
// $query = $mysqli->query("SELECT * FROM table_name");
$sql = "SELECT * FROM volunteer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "volunteer_id: " . $row["volunteer_id"]. " - Name: " . $row["name"]. " " . $row["description"]. "<br>";
    }
} else {
    echo "0 results";
}
 
// if ($result = $mysqli->query($query)) {
 
//     /* fetch associative array */
//     while ($row = $result->fetch_assoc()) {
//         $field1name = $row["col1"];
//         $field2name = $row["col2"];
//         $field3name = $row["col3"];
//         $field4name = $row["col4"];
//         $field5name = $row["col5"];
//     }
 
//     /* free result set */
//     $result->free();
// }

// $sql = "SELECT id, firstname, lastname FROM MyGuests";
// $result = $conn->query($sql);





//I am commenting this code out because I am redirecting to the same page and I dont want it to affect my 'message sent successfully code' from my js file. For test you can use below--
		// echo "Connection successful";





if (isset($_POST)){
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$formEmail = $_POST["formEmail"];
	$formSubject = $_POST["formSubject"];
	$formMessage = $_POST["formMessage"];
}

//Attempt insert query execution to your table
	$sql = "INSERT INTO messages (firstName, lastName, formEmail, formSubject, formMessage) VALUES ('$firstName', '$lastName', '$formEmail', '$formSubject', '$formMessage')";

	if (!mysqli_query($conn, $sql)) {
		//I am commenting this code out because I am redirecting to the same page and I dont want it to affect my 'message sent successfully code' from my js file. For test you can use below--
	// 	echo "Records inserted successfully";
	// }else{
		echo "Error in inserting records" .mysqli_error($conn);
	}

//Close connection
	mysqli_close($conn);


//Declaring the variable that helps us echo error messages for different fields.
	$errorMSG = "";

//Validation for the different form fields
	//FirstName
	if (empty($_POST["firstName"])) {
		$errorMSG = "First name/Anonymous is required";
	}else{
		$firstName = $_POST["firstName"];
	}

	//LastName
	if(empty($_POST["lastName"])) {
		$errorMSG = "Last name/Anonymous is required";
	}else{
		$lastName = $_POST["lastName"];
	}

	//Email field
	if(empty($_POST["formEmail"])){
		$errorMSG = "A valid email address is required";
	}else{
		$formEmail = $_POST["formEmail"];
	}

	//Message field
	if (empty($_POST["formMessage"])) {
		$errorMSG = "Please leave a message";
	}else{
		$formMessage = $_POST["formMessage"];
	}


	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$formEmail = $_POST["formEmail"];
	$formSubject = $_POST["formSubject"];
	$formMessage = $_POST["formMessage"];


	//Compose body of email
	$Body = "";
	$EmailTo = "nmaokaforr@yahoo.com";
	$Subject = "New message from Supply Aid website received";

	$Body .= "firstName";
	$Body .= $firstName;
	$Body .= "\n";

	$Body .= "lastName";
	$Body .= $lastName;
	$Body .= "\n";

	$Body .= "formEmail";
	$Body .= $formEmail;
	$Body .= "\n";

	$Body .= "formSubject";
	$Body .= $formSubject;
	$Body .= "\n";

	$Body .= "formMessage";
	$Body .= $formMessage;
	$Body .= "\n";


	//Send email to domain contact email
	$success = mail($EmailTo, $Subject, $Body, "From: ".$formEmail);
	//redirect to success page, in this case - same page
	if($success && $errorMSG == ""){
		echo "success";
	}else if($errorMSG == ""){
		echo "Something went wrong";
	}else{
		echo $errorMSG;
	}

?>