<?php
session_start();
//session_destroy();
if (!isset($_SESSION['add'])) {
    $_SESSION['add'] = array();
}
if (!isset($_SESSION['buy'])) {
    $_SESSION['buy'] = array();
}
if (!isset($_SESSION['wish'])) {
    $_SESSION['wish'] = array();
}
?>
<?
if (isset($_POST['action']) && $_POST['action'] == "addToCart") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = 1;
    $array1 = array($id, $name, $image, $price, $quantity);
    array_push($_SESSION['add'], $array1);
    echo json_encode($_SESSION['add']);

}
if (isset($_POST['action']) && $_POST['action'] == "buyNow") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = 1;
    $array1 = array($id, $name, $image, $price, $quantity);
    array_push($_SESSION['buy'], $array1);
    echo json_encode($_SESSION['buy']);

}
if (isset($_POST['action']) && $_POST['action'] == "addToWishlist") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = 1;
    $array1 = array($id, $name, $image, $price, $quantity);
    array_push($_SESSION['wish'], $array1);
    echo json_encode($_SESSION['wish']);

}
if (isset($_POST['action']) && $_POST['action'] == "remove") {
    $id = $_POST['id'];
    array_splice($_SESSION['add'],$id,1);
    echo json_encode($_SESSION['add']);
}
if (isset($_POST['action']) && $_POST['action'] == "remove1") {

    $id = $_POST['id'];
    array_splice($_SESSION['buy'],$id,1);
    echo json_encode($_SESSION['buy']);
}
if (isset($_POST['action']) && $_POST['action'] == "remove2") {
    $id = $_POST['id'];
    array_splice($_SESSION['wish'],$id,1);
    echo json_encode($_SESSION['wish']);
}
if (isset($_POST['action']) && $_POST['action'] == "add1") {
    $id = $_POST['id'];
    array_push($_SESSION['add'], $_SESSION['buy'][$id]);
    array_splice($_SESSION['buy'],$id,1);
    echo json_encode($_SESSION['add']);
}
if (isset($_POST['action']) && $_POST['action'] == "add2") {
    $id = $_POST['id'];
    array_push($_SESSION['add'], $_SESSION['wish'][$id]);
    array_splice($_SESSION['wish'],$id,1);
    echo json_encode($_SESSION['add']);
}
if (isset($_POST['action']) && $_POST['action'] == "buy1") {
    $id = $_POST['id'];
    array_push($_SESSION['buy'], $_SESSION['add'][$id]);
    array_splice($_SESSION['add'],$id,1);
    echo json_encode($_SESSION['buy']);
}
if (isset($_POST['action']) && $_POST['action'] == "buy2") {
    $id = $_POST['id'];
    array_push($_SESSION['buy'], $_SESSION['wish'][$id]);
    array_splice($_SESSION['wish'],$id,1);
    echo json_encode($_SESSION['buy']);
}
if (isset($_POST['action']) && $_POST['action'] == "wish1") {
    $id = $_POST['id'];
    array_push($_SESSION['wish'], $_SESSION['add'][$id]);
    array_splice($_SESSION['add'],$id,1);
    echo json_encode($_SESSION['wish']);
}
if (isset($_POST['action']) && $_POST['action'] == "wish2") {
    $id = $_POST['id'];
    array_push($_SESSION['wish'], $_SESSION['buy'][$id]);
    array_splice($_SESSION['buy'],$id,1);
    echo json_encode($_SESSION['wish']);
}
?>