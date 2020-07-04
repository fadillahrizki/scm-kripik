<?php

require_once 'db.php';

session_start();

function login($data){
    global $conn;
    extract($data);
    $query = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
    $res = $conn->query($query);
    $login = $res->fetch_assoc();

    if($login){
        $_SESSION["user"] = $login;
        $_SESSION["user"]["level"] = "admin";
        header("location:index.php");
    }else{
        $query = "SELECT * FROM tb_supplier WHERE username='$username' AND password='$password'";
        $res = $conn->query($query);
        $login = $res->fetch_assoc();

        if($login){
            $_SESSION["user"] = $login;
            $_SESSION["user"]["level"] = "supplier";
            echo 'supplier logged in';
            header("location:index.php");
        }else{
            header("location:login.php");
        }
    }
}

function getCount($tbl){
    global $conn;
    $query = "SELECT * FROM $tbl";
    $res = $conn->query($query);
    return count($res->fetch_all(MYSQLI_ASSOC));
}

function get($tbl){
    global $conn;
    $query = "SELECT * FROM $tbl";
    $res = $conn->query($query);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function truncate($tbl){
    global $conn;
    $query = "TRUNCATE $tbl";
    $res = $conn->query($query);
    return $res;
}

function getForSupplier($id){
    global $conn;
    $query = "SELECT * FROM tb_pembelian WHERE id_supplier=$id AND keterangan='checkout'";
    $res = $conn->query($query);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function getFaktur($id,$filter){
    global $conn;
    $query = "SELECT * FROM tb_pembelian WHERE id_supplier=$id AND keterangan IN ('diterima','selesai') AND tanggal BETWEEN '$filter[from]' AND '$filter[to]'";
    $res = $conn->query($query);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function getPembelianFilter($filter){
    global $conn;
    $query = "SELECT * FROM tb_pembelian WHERE keterangan IN ('ditolak','diterima','selesai') AND tanggal BETWEEN '$filter[from]' AND '$filter[to]'";
    $res = $conn->query($query);
    return $res->fetch_all(MYSQLI_ASSOC);
}

function single($tbl,$id){
    global $conn;
    $query = "SELECT * FROM $tbl where id=$id";
    $res = $conn->query($query);
    return $res->fetch_assoc();
}

function singleBahan($nama){
    global $conn;
    $query = "SELECT * FROM tb_bahan_baku where nama_bahan_baku='$nama'";
    $res = $conn->query($query);
    return $res->fetch_assoc();
}

function insert($tbl,$data){
    global $conn;
    $key = "(";
    $val = "(";
    $i = 0;
    foreach($data as $k => $v){
        if($i == count($data)-1){
            $key .= "$k)";
            $val .= "'$v')";
        }else{
            $key .= "$k,";
            $val .= "'$v',";
            $i++;
        }
    }
    $query = "INSERT INTO $tbl $key VALUES $val";
    $res = $conn->query($query);
    return $res;
}

function update($tbl,$data,$id){
    global $conn;
    $val = "";
    $i = 0;
    foreach($data as $k => $v){
        if($i == count($data)-1){
            $val .= "$k='$v'";
        }else{
            $val .= "$k='$v',";
            $i++;
        }
    }
    $query = "UPDATE $tbl SET $val WHERE id=$id";
    $res = $conn->query($query);
    return $res;
}

function updateBahan($data,$nama){
    global $conn;
    $val = "";
    $i = 0;
    foreach($data as $k => $v){
        if($i == count($data)-1){
            $val .= "$k='$v'";
        }else{
            $val .= "$k='$v',";
            $i++;
        }
    }
    $query = "UPDATE tb_bahan_baku SET $val WHERE nama_bahan_baku='$nama'";
    $res = $conn->query($query);
    return $res;
}

function delete($tbl,$id){
    global $conn;
    $query = "DELETE FROM $tbl WHERE id=$id";
    $res = $conn->query($query);
    return $res;
}