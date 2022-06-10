<?php

include_once('./classes/static_methods_class.php');
Static_methods::validate();

?>

<!doctype html>
<html lang="en">
   <head>
      <title></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <link rel="stylesheet" href="./css/lands_page.css">
      <link rel="stylesheet" href="./css/lands_page_custom.css">
      <meta name="robots" content="noindex, follow">
      <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

   </head>
   <body>
      <div class="wrapper d-flex align-items-stretch">
         <nav id="sidebar" class="active">
            <div class="custom-menu">
               <button type="button" id="sidebarCollapse" class="btn btn-primary">
               <i class="fa fa-bars"></i>
               <span class="sr-only">Toggle Menu</span>
               </button>
            </div>
            <div class="p-4 pt-5">
               <h1><a href="#" class="logo">Welcome</a></h1>
               <ul class="list-unstyled components mb-5">
                  <li class="active">
                     <a href="admin_page.php">მთავარი</a>
                  </li>
                  <li>
                     <a href="orders.php">შეკვეთები</a>
                  </li>
                  <li>
                     <a href="create_product.php">დამატება</a>
                  </li>
                  <li class="active">
                    <form action="./templates/logout.php" method="post">
                      <input type="hidden" name="logout">
                      <a onclick="this.parentNode.submit();" href="#Contact">Log out</a>
                    </form>

                  </li>
               </ul>

               <div class="footer">
                  <p>
                     Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                  </p>
               </div>
            </div>
         </nav>
