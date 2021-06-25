<?php
//CONECTANDO AO BANCO DE DADOS
const HOST = "localhost";
const USER = "root";
const PASSWORD = "bcd127";
const DATABASE = "icatalogo";

//realiza a conexão com o banco de dados
$conexao = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die(mysqli_connect_error());

