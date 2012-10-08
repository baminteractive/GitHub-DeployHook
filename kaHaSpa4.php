<?php

require_once('class.GitHubHook.php');

// Added by nate@bamads.com - server specific

date_default_timezone_set('America/New_York');

ini_set('safe_mode', '0');

// Initiate the GitHub Deployment Hook; Passing true to enable debugging
$hook = new GitHubHook(true);

// Adding `stage` branch to deploy for `staging` to path `/var/www/testhook/stage`
$hook->addBranch('master', 'staging', '/var/www/vhosts/bamads.com/subdomains/bam/httpdocs/interactive/xbox');

// Deploy the commits
$hook->deploy();