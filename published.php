
<?php
require 'core/init.php';
error_reporting(0);

if(logged_in() === false){

    session_destroy();
    header('Location:index.php');
    exit();

}

require  'components/page_head.php'; ?>

<script>

    $(document).ready(function() {
        $('#myDatatable').DataTable();
    });


</script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>CSC</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>CSC</b>  UCSC</span>
        </a>

        <!-- Header Navbar -->
        <?php include "components/navbar.php";?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <?php include 'components/sidebar_head.php'?>
            <?php include 'components/sidebar.php'?>
            <!-- Sidebar Menu --

    <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Published Posts

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Posts</a></li>
                        <li class="active">Published</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Users</h3>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">

                                    <?php $id = $user_data['id']; ?>
                                    <table class="table table-striped table-bordered" id="myDatatable">
                                        <thead>
                                        <tr>
                                            <th style='text-align: center'>ID</th>
                                            <th style='text-align: center'>User Name</th>
                                            <th style='text-align: center'>Role</th>
                                            <th style='text-align: center'>Title</th>
                                            <th style='text-align: center'>Date</th>

                                        </tr>

                                        </thead>
                                        <tbody>
                                        <?php
                                        $result=published($con,$id);

                                        while($row = $result->fetch_assoc()) {

                                            echo "<tr>";
                                            echo "<td style='text-align: center'>" . $row["adminid"] . "</td>";
                                            echo "<td style='text-align: center'>" . $row["name"] . '</td>';
                                            echo '<td style="text-align: center">' . $row['role'] . '</td>';
                                            echo '<td style="text-align: center">' . $row['subject'] . '</td>';
                                            echo '<td style="text-align: center">' . $row['date'] . '</td>';

                                            echo '</tr>';




                                        }

                                        ?>


                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include "components/footer.php"; ?>
            <?php include "components/activity_bar.php"; ?>

            <div class="control-sidebar-bg"></div>
</div>

<?php require  'components/page_tail.php'; ?>