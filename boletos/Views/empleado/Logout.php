<?php
session_start();
session_destroy();
header("location:?e=Empleados&a=Index");
?>