<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php
        if (!empty($page_title)) {
            echo remove_junk($page_title);
        } elseif (!empty($user)) {
            echo ucfirst($user['name']);
        } else {
            echo "Inventory Management System";
        }
    ?></title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css">

    <link rel="stylesheet" href="libs/css/main.css">
    <link rel="stylesheet" href="libs/css/dashboard.css" />

    <!-- Modern dashboard styling -->
    <style>
        body {
            background: #f4f7fb;
            color: #263247;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        #header {
            background: #ffffff;
            min-height: 70px;
            border-bottom: 1px solid #e7ecf3;
            box-shadow: 0 2px 10px rgba(20, 40, 80, 0.04);
        }

        #header .logo {
            background: #172554;
            color: #ffffff;
            width: 250px;
            min-height: 70px;
            padding: 24px 20px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        #header .header-content {
            margin-left: 250px;
            min-height: 70px;
            padding: 0 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #header .header-date {
            padding-top: 0;
            color: #718096;
            font-size: 13px;
        }

        #header .info-menu {
            margin: 0;
        }

        #header .profile > a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #263247;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
        }

        #header .profile > a:hover {
            background: #f1f5f9;
        }

        #header .profile img {
            width: 36px;
            height: 36px;
            object-fit: cover;
        }

        #header .dropdown-menu {
            border: 1px solid #e7ecf3;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(20, 40, 80, 0.12);
            padding: 8px;
        }

        #header .dropdown-menu a {
            padding: 10px 12px;
            border-radius: 6px;
        }

        #header .dropdown-menu a:hover {
            background: #f1f5f9;
        }

        .sidebar {
            background: #172554;
            width: 250px;
            min-height: calc(100vh - 70px);
        }

        .sidebar ul {
            padding-left: 0;
            list-style: none;
        }

        .sidebar > ul {
            padding-top: 20px;
        }

        .sidebar li a {
            display: block;
            color: #cbd5e1;
            padding: 14px 22px;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar li a:hover,
        .sidebar li a:focus {
            background: #253765;
            color: #ffffff;
        }

        .sidebar li a .glyphicon {
            margin-right: 10px;
        }

        .sidebar .submenu {
            background: #111c40;
        }

        .sidebar .submenu li a {
            padding: 11px 20px 11px 52px;
            font-size: 13px;
        }

        .page {
            margin-left: 250px;
            padding: 28px;
            min-height: calc(100vh - 70px);
        }

        .page .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .page-header {
            border-bottom: 1px solid #e2e8f0;
        }

        .table {
            background: #ffffff;
            border-radius: 8px;
        }

        .table thead th {
            background: #f1f5f9;
            color: #334155;
        }

        .btn {
            border-radius: 6px;
        }

        .form-control {
            border-radius: 6px;
            border-color: #dbe3ee;
            box-shadow: none;
            min-height: 38px;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.12);
        }

        @media (max-width: 768px) {
            #header .logo {
                width: 100%;
                min-height: auto;
                padding: 16px 20px;
            }

            #header .header-content {
                margin-left: 0;
                padding: 10px 15px;
                min-height: 60px;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .page {
                margin-left: 0;
                padding: 18px 12px;
            }
        }
    </style>
</head>

<body>

<?php if ($session->isUserLoggedIn(true)): ?>

    <header id="header">

        <div class="logo pull-left">
            <span class="glyphicon glyphicon-th-large"></span>
            Inventory System
        </div>

        <div class="header-content">

            <div class="header-date">
                <strong><?php echo date("F j, Y, g:i a"); ?></strong>
            </div>

            <div class="clearfix">

                <ul class="info-menu list-inline list-unstyled">

                    <li class="profile">

                        <a href="#" data-toggle="dropdown"
                           aria-expanded="false">

                            <img
                                src="uploads/users/<?php echo $user['image']; ?>"
                                alt="User profile"
                                class="img-circle img-inline">

                            <span>
                                <?php echo remove_junk(ucfirst($user['name'])); ?>
                                <i class="caret"></i>
                            </span>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">

                            <li>
                                <a href="profile.php?id=<?php echo (int)$user['id']; ?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a href="edit_account.php" title="Edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                </a>
                            </li>

                            <li>
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    Logout
                                </a>
                            </li>

                        </ul>

                    </li>

                </ul>

            </div>

        </div>

    </header>

    <div class="sidebar">

        <?php if ($user['user_level'] === '1'): ?>

            <?php include_once('admin_menu.php'); ?>

        <?php elseif ($user['user_level'] === '2'): ?>

            <?php include_once('special_menu.php'); ?>

        <?php elseif ($user['user_level'] === '3'): ?>

            <?php include_once('user_menu.php'); ?>

        <?php endif; ?>

    </div>

<?php endif; ?>

<div class="page">
    <div class="container-fluid">