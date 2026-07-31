<?php
/*
All sensitive credentials stored here.

NOTE: change this file name from credentials.example.php to credentials.php
*/

error_reporting(0);

$databaseHost = getenv('DB_HOST') ?: "localhost";
$databaseUsername = getenv('DB_USER') ?: "root";
$databasePassword = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "";
$databaseName = getenv('DB_NAME') ?: "main";

$mysqlRequireSSL = false; // in case the MySQL server requires SSL


$logwebhook = ""; // discord webhook which receives login logs and keys created

$adminwebhook = ""; // discord webhook which receives admin actions

$redisServers = []; // URLs to purge redis keys from each server (used on live AsAuth website only)

$redisPass = "";

$asauthStatsToken = ""; // discord bot token for AsAuth Stats

$webhookun = "AsAuth Logs"; // webhook username

$adminwebhookun = "AsAuth Admin Logs"; // admin webhook's username

$awsAccessKey = ""; // used for AWS SES to send emails

$awsSecretKey = ""; // used for AWS SES to send emails
