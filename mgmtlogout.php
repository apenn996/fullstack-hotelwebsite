<?php

session_start();
session_unset();
session_destroy();

header("Location: mgmtindex.php?status=loggedout");