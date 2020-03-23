<?php
    include("../credential.php");
    include"dbHelper.php";
    session_start();
?>
<!DOCTYPE html>

<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="description" content="Hello Librarian">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>




<style>

.btn{
    border-radius:8px;
}
.profileImage {
  width: 150px;
  height: 35px;
  border-radius: 50%;
  background: #512DA8;
  font-size: 18px;
  color: #fff;
  text-align: center;
  line-height: 35px;
  margin: 20px 0;
}


</style>
</head>
<body>

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">Welcome, <?php echo $_SESSION['admin']; ?></a>
            <a class="navbar-brand hidden" href="./"><small style="font-size:15px; margin-right:20px;"><% Response.Write(Application["admin"]); %></small></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">Menus</h3>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Librarian</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-user"></i><a href="addadmin.php">Add new Librarian</a></li>
                        <li><i class="fa fa-user"></i><a href="show-admin.php">See All Librarian</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Books</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-book"></i><a href="add-book.php">Add new Book</a></li>
                        <li><i class="fa fa-book"></i><a href="show-books.php">See All Book</a></li>
                    </ul>
                </li>
                <li>
                    <a href="add-publication.php"> <i class="menu-icon fa fa-plus"></i>Add Publication</a>
                </li>
                <li>
                    <a href="issue-book.php"> <i class="menu-icon fa fa-book"></i>Issue Book</a>
                </li>
                <li>
                    <a href="return_book_list.php"> <i class="menu-icon fa fa-book"></i>Return Book</a>
                </li>
                <li>
                    <a href="contact.php"> <i class="menu-icon fa fa-comments"></i>Users Feedback</a>
                </li>
                <li>
                    <a href="notice.php"> <i class="menu-icon fa fa-commenting"></i>Notice</a>
                </li>
                <li>
                    <a href="../logout.php"> <i class="menu-icon fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>

<div id="right-panel" class="right-panel" style="width:100%;">


    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-12">

                <font size="7em">VEGFOODS, Online anywhere ; )</font>

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <p class="user-avatar profileImage">
                            <b style="color:white;"><asp:Label ID="sbstr" runat="server" Text="" /></b>
                        </p>
                    </a>

                    <div class="user-menu dropdown-menu">
                        Hello, <?php echo $_SESSION['admin']; ?>
                        <a class="nav-link" href="profile.php"><i class="fa fa- user"></i>My Profile</a>

                        <a class="nav-link" href="changepass.php"><i class="fa fa- user"></i>Change Password</a>

                        <a class="nav-link" href="contact.php"><i class="fa fa- user"></i>User's Feedback</a>

                        <a class="nav-link" href="../logout.php"><i class="fa fa- user"></i>Log-out</a>

                    </div>
                </div>

            </div>
        </div>

    </header>

    <div class="content mt-3">