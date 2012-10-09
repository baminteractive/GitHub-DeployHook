<?php

require_once('class.GitHubHook.php');

// Added by nate@bamads.com - server specific

date_default_timezone_set('America/New_York');

ini_set('safe_mode', '0');

// Initiate the GitHub Deployment Hook; Passing true to enable debugging
$hook = new GitHubHook(true);

// TODO: Update branch names and path to files
// Adding `develop` branch to deploy for `staging` to path `/path/to/directory/`
$hook->addBranch('staging', 'staging', '/path/to/directory/');

// Deploy the commits
$hook->deploy();