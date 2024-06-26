<?php
 session_start();
 $con = mysqli_connect("localhost","root","","ecom");
 
 if(isset($_POST['signup'])){
  $stat  = 0;
  $message = "";
  $errors = [];
  if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])){
    array_push($errors,"All fields are required.");
  }
  $checkqry = mysqli_query($con,"SELECT * FROM user WHERE email='".$_POST['email']."' ");
  if($checkqry->num_rows > 0){
    array_push($errors,"Email already existing.");
  }
   if(!count($errors)){
    if(mysqli_query($con,"INSERT INTO `user`(`name`, `email`, `password`) value('".$_POST['name']."','".$_POST['email']."','".md5($_POST['password'])."') ")){
      $stat  = 1;
      $message = "You record was added.";
    }else{
      array_push($errors,"An error occured while processing your request.");
    }
   }
 
   echo json_encode([
    "stat"=>$stat,
    "message"=>$message,
    "errors"=>$errors,
    "date"=>date("d M, Y.")
  ]);
 }

 if(isset($_GET['sign_in'])){
  //echo "HEHE";
  if(!isset($_POST['email']) || !isset($_POST['password'])){
    array_push($errors,"All fields are required.");
  }
  $checkqry = mysqli_query($con,"SELECT * FROM user WHERE email='".$_POST['email']."' && password='".md5($_POST['password'])."'  ");
  if($checkqry->num_rows > 0){
   
  }else{
    array_push($errors,"Invalid password.");
  }

 }









