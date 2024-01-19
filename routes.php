<?php
$routerController->get("/", "index.php");
$routerController->get("/about", "about.php");

// CONTROLLER ROUTES
$routerController->get("/login", "auth/formlogin.php");
$routerController->post("/store", "auth/store.php");
$routerController->delete("/logout", "auth/destroy.php")->only("auth");

$routerController->get("/student", "student/index.php")->only("auth")->role("STUDENT");

$routerController->get("/staff", "staff/index.php")->only("auth")->role("STAFF");
$routerController->patch("/staff/update", "staff/update.php")->only("auth")->role("STAFF");

$routerController->get("/dean", "dean/index.php")->only("auth")->role("DEAN");
$routerController->patch("/dean/update", "dean/update.php")->only("auth")->role("DEAN");

$routerController->get("/superadmin", "superadmin/index.php")->only("auth")->role("SUPERADMIN");
$routerController->post("/superadmin/store", "superadmin/store.php")->only("auth")->role("SUPERADMIN");
$routerController->delete("/superadmin/destroy", "superadmin/destroy.php")->only("auth")->role("SUPERADMIN");

// API ROUTES
$routerApi->get("/api/sample", "sample.php");

// $routerApi->get("/api/login", "auth/formlogin.php");
$routerApi->post("/api/login", "auth/store.php");
$routerApi->delete("/api/logout", "auth/destroy.php")->only("auth");

$routerApi->get("/api/student", "student/index.php")->only("auth")->role("STUDENT");

$routerApi->get("/api/staff", "staff/index.php")->only("auth")->role("STAFF");
$routerApi->patch("/api/staff/update", "staff/update.php")->only("auth")->role("STAFF");

$routerApi->get("/api/dean", "dean/index.php")->only("auth")->role("DEAN");
$routerApi->patch("/api/dean/update", "dean/update.php")->only("auth")->role("DEAN");

$routerApi->get("/api/superadmin", "superadmin/index.php")->only("auth")->role("SUPERADMIN");
$routerApi->post("/api/superadmin/store", "superadmin/store.php")->only("auth")->role("SUPERADMIN");
$routerApi->delete("/api/superadmin/destroy", "superadmin/destroy.php")->only("auth")->role("SUPERADMIN");
