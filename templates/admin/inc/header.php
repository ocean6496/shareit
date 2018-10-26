<?php  
    session_start();
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/DBConnectionUtil.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/CheckUserUtil.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/functions/ConstantUtil.php';
?>
<!DOCTYPE html>
<!-- saved from url=(0039)http://shareit.vinaenter.edu.vn/admincp -->
<html xmlns="https://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="SHORTCUT ICON" href="https://shareit.vinaenter.edu.vn/public/templates/admin/img/icon.png">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>ShareIT | Trang chủ</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="/templates/admin/css/bootstrap.css" rel="stylesheet">
    <!-- FONT AWESOME STYLE  -->
    <link href="/templates/admin/css/font-awesome.css" rel="stylesheet">
    <!-- CUSTOM STYLE  -->
    <link href="/templates/admin/css/style.css" rel="stylesheet">
    <!-- GOOGLE FONT -->
    <link href="/templates/admin/fonts/glyphicons-halflings-regular.woff" type="text/css">
    <link href="/templates/admin/fonts/fontawesome-webfont.woff" type="text/css">
    <link href="/templates/admin/css/t.css" rel="stylesheet" type="text/css">
    <link href="/templates/admin/css/dataTables.bootstrap.css" rel="stylesheet">
    <!--SCRIPT-->
    <script src="/libraries/jquery-3.3.1.min.js"></script>
    <script src="/libraries/jquery.validate.min.js"></script>
    <script src="/libraries/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="/templates/admin/js/ckfinder.js" type="text/javascript"></script>
</head>
<body style="">
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://shareit.vinaenter.edu.vn/admincp">

                    <img src="/templates/admin/images/logo1.png">
                </a>

            </div>

            <div class="right-div">
                                <span class="" style="margin-right:10px;text-transform:uppercase;font-weight: bold;padding-top:2%   "><i>Chào <?php echo $_SESSION['userInfo']['fullname']; ?></i></span><a href="/admin/auth/logout.php" class="btn btn-danger pull-right">Đăng xuất</a>
                            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                         
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="/admin/index.php" class="menu-top-active">Trang chủ</a></li>
                           <li><a href="/admin/category/index.php" class="menu-top-">Quản lý danh mục</a></li>
                            <li><a href="/admin/news/index.php" class="  menu-top-">Quản lý tin tức &nbsp</a></li> 
                            <li><a href="/admin/user/index.php" class="menu-top-">Quản lý người dùng</a></li> 
                            <li><a href="/admin/comment/index.php" class=" menu-top-">Quản lý bình luận</a></li> 
                            <li><a href="/admin/contact/index.php" class=" menu-top-">Quản lý liên hệ</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>