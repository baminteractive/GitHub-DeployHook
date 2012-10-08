## GitHub Deployment Hook

Deploying applications to development, staging and production never been so easy with GitHub Post-Receive Deployment Hook script!

### Installation

**Update your repo**

1. Clone the script and copy it into your repo.

2. Do a search for `TODO` to find the areas in the code you'll need to customize. In short, you'll need to specify the full server path to the repository you're wanting to update and the name of the specific branch you're wanting to update.

3. Check the updated code into your repo.

**Update GitHub**

1. Go to your `GitHub repo` &gt; `Admin` &gt; `Teams` &gt;, select `Machines` from the list of Teams and add it to the respository. This will give the server access to the repository.
2. Go to your `GitHub repo` &gt; `Admin` &gt; `Service Hooks`, select `Post-Receive URLS` and enter your hook URL like this:

![GitHub Post-Receive URLs](http://s3.kcblog.net/images/GitHubHook-01.png)

**Prepare the server**

1. SSH into the server.
2. `cd` into one directory higher than your files will be served from.
3. Clone the repo onto the server. `git clone git@github.com:baminteractive/path-to-your-repo.git`
4. Delete the directory your files will be served from and rename the cloned directory the same as the directory your deleted. `mv path/to/cloned/directory path/to/http/directory`
5. Make sure to switch to the branch you're wanting to auto-deploy if it's not there already. Use `git fetch` to pull down the branches from the remote server. 
6. Set git repo directory to 755 `chmod -R 755 path/to/directory`
7. Set the `apache` user as the owner so the server is allowed to refresh the repo `chown -R apache:apache httpdocs`

### How It Works

GitHub provides [Post-Receive Hooks](http://help.github.com/post-receive-hooks/) to allow HTTP callback with a HTTP Post. We then create a script for the callback to deploy the systems automatically.

You will need to create branches like `develop` and `staging` in Git before proceeding into the configurations.

You then can have a brief look into `hook.php`, a WebHook example provided for you to experience how simple the configurations are.

<pre><code>&lt;?php
require_once('class.GitHubHook.php');

// Initiate the GitHub Deployment Hook
$hook = new GitHubHook;

// Enable the debug log, kindly make `log/hook.log` writable
$hook-&gt;enableDebug();

// Adding `stage` branch to deploy for `staging` to path `/var/www/testhook/stage`
$hook-&gt;addBranch('stage', 'staging', '/var/www/stage');

// Adding `prod` branch to deploy for `production` to path `/var/www/testhook/prod`
$hook-&gt;addBranch('prod', 'production', '/var/www/prod', array('user@gmail.com'));

// Deploy the commits
$hook-&gt;deploy();
</code></pre>

In this example, we enabled the debug log for messages with timestamp. You can disable this by commenting or removing the line `$hook->enableDebug()`

We have a staging site and a production site in this example. You can add more branches easily with `$hook->addBranch()` method if you have more systems to deploy.

We then use `$hook->deploy()` to deploy the systems.

## 

### Security

We have enabled IP check to allow only GitHub hook addresses: `207.97.227.253`, `50.57.128.197` to deploy the systems. We also return a `404 Not Found` page when there is illegal access to the hook script.

For better security, rename this file to a bunch of random characters like `a40b6cf7a5.php`. I use this [password generator](http://www.pctools.com/guides/password/) to come up with random characters when I'm stuck.

### For Developers

We are trying to make developers life easier. Kindly fork this on GitHub and submit your pull requests to help us.