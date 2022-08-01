<?php 
$conn = new mysqli("localhost", "root", "", "patientcare");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
