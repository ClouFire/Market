<?php

define("ROOT", dirname(__DIR__));

const DEBUG = 1;
const CONFIG = ROOT . '/config';
const HELPERS = ROOT . '/helpers';
const APP = ROOT . '/app';
const CORE = ROOT . '/core';
const VIEWS = APP . '/Views';
const LAYOUT = 'default';
const PATH = '/Market';
const ERROR_LOGS = ROOT . '/tmp/error.log';
const WWW = ROOT . '/public';

const DB_SETTINGS = [
    "name" => "market",
    "host" => "localhost",
    "pass" => "",
    "login" => "root",
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];

const PAGINATION_SETTINGS = [
        'perPage' => 4,
        'midSize '=> 4,
        'maxPages' => 7,
        'tpl' => 'pagination/base',
];