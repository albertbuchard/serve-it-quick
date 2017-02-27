#serveItQuick
A node-php server platform with the simplest of custom router for local development.

!! Subdomains work on Chrome only for now !!

#Install
First, you need to install node.js: https://nodejs.org/en/

Then in your terminal:
```Shell
    $echo "127.0.0.1  \*.locahost" >> /etc/hosts
    $git clone https://github.com/albertbuchard/serve-it-quick.git
    $cd serve-it-quick
    $npm install
    $node serve
```
And voila!
Php server + router running on http://subdomainExample.localhost:8000

#Does not work !?
Ok if it does not work it might be due to your /etc/hosts that does not redirect
subdomain.localhost to your localhost.
One way to circumvent that is either add \*.localhost to your etc/hosts:

```Shell
  $sudo -- sh -c -e "echo '127.0.0.1   \*.localhost' >> /etc/hosts";
```

This will work for chrome, but not safari. For safari you have to explicitly add your
subdomain name:

```Shell
  $sudo -- sh -c -e "echo '127.0.0.1   sundomainName.localhost' >> /etc/hosts";
```

Post an issue if it still does not work !

#Customize
The php router file is in lib/server/router.php. To customize the router you can change the subdomains :

1) Set your default subdomain, where http://localhost:8000 points to

```PHP
    $defaultSubdomain = "subdomain-example";
```

2) Set all the valid subdomains. As default you have http://another-subdomain.localhost:8000/ also setup:
```PHP
    $validSubdomains = array("subdomain-example",
      "another-subdomain");
```

3) By default the router will look for the subdomain _and the views_ in public/html/subdomain. Change that as needed:
```PHP
    $pathToWebFolder = "public/html/".$subdomain."/";
    $pathToViews = "public/html/".$subdomain."/";
```
4) By default it looks for an index.php or index.html. An error is returned if the path does not contain an index file :
```PHP
    if ($url["path"]=="/") {
      if (file_exists($pathToViews."index.html")) {
        include $pathToViews."index.html";
      } else if (file_exists($pathToViews."index.php")) {
        include $pathToViews."index.php";
      } else {
        echo("Router Error: No index file found. ". $pathToViews."index.php not found !");
      }

      exit;
    }
```
#Dependencies
node

node-php-server

php if you are on windows

# Current known issue
Sometimes does not find the file when using include or require with "./" in the include path.

#License
MIT
