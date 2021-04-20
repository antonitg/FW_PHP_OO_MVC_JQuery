<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/cars/';
include($path . "module/cars/model/DAOUser.php");
// session_start();

switch ($_GET['op']) {
    case 'list';
        try {
            $daouser = new DAOUser();
            $rdo = $daouser->select_all_user();
        } catch (Exception $e) {
            $callback = 'index.php?page=503';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if (!$rdo) {
            $callback = 'index.php?page=503';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("module/cars/view/list_user.php");
        }
        break;

    case 'create';

        if (!empty($_POST['Registration'])) {
            try {
                echo $_POST["Brand"];
                $daouser = new DAOUser();
                if (!$daouser->check_key($_POST["Registration"])) {
                    echo '<script language="javascript">alert("ERROR: This Registration is already in the database")</script>';
                    $callback = 'index.php?page=controller_user&op=create';
                    die('<script>window.location.href="' . $callback . '";</script>');
                }
                $rdo = $daouser->insert_user($_POST);
            } catch (Exception $e) {
                echo "<script>alert('Al catch');</script>";
                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if ($rdo) {
                echo '<script language="javascript">alert("Registrado en la base de datos correctamente")</script>';
                $callback = 'index.php?page=controller_user&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                echo "<script>alert('res al ultim 503');</script>";

                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
        }
        include("module/cars/view/create_user.html");
        break;

    case 'update';
        if (isset($_POST['update'])) {

            try {
                $daouser = new DAOUser();
                $rdo = $daouser->update_user($_POST);
            } catch (Exception $e) {

                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
            if ($rdo) {
                $callback = 'index.php?page=controller_user&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
        }

        try {
            $daouser = new DAOUser();
            $rdo = $daouser->select_user($_GET['id']);
            $user = get_object_vars($rdo);
        } catch (Exception $e) {
            $callback = 'index.php?page=503';
            die('<script>window.location.href="' . $callback . '";</script>');
        }

        if (!$rdo) {
            $callback = 'index.php?page=503';
            die('<script>window.location.href="' . $callback . '";</script>');
        } else {
            include("module/cars/view/update_user.php");
        }
        break;
    case 'read';
        //echo "<script>console.log('Entra UO');</script>";
        try {
            $daouser = new DAOUser();
            $rdo = $daouser->select_user($_GET['id']);
            $car = get_object_vars($rdo);
        } catch (Exception $e) {
            //echo "<script>alert('Acaba en el primer try');</script>";
            echo json_encode("no arriba al daouser");
            exit;
        }
        if (!$rdo) {
            //echo "<script>alert('Acaba en el segon try');</script>";
            echo json_encode("entra al daouser pero acaba mal");
            exit;
        } else {
            $car = get_object_vars($rdo);
            echo json_encode($car);
            //echo json_encode("error");
            exit;
        }
        break;

    case 'delete';
        if (isset($_POST['delete'])) {
            try {
                $daouser = new DAOUser();
                $rdo = $daouser->delete_user($_GET['id']);
            } catch (Exception $e) {
                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }

            if ($rdo) {
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?page=controller_user&op=list';
                die('<script>window.location.href="' . $callback . '";</script>');
            } else {
                $callback = 'index.php?page=503';
                die('<script>window.location.href="' . $callback . '";</script>');
            }
        }

        include("module/cars/view/delete_user.php");
        break;
    default;
        include("view/inc/error404.php");
        break;
}
