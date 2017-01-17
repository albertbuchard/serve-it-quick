#serveItQuick
A node-php server platform with the simplest of custom router for local development.

!! Subdomains work on Chrome only for now !!

#Install
First, you need to install node.js: https://nodejs.org/en/

Then in your terminal:

    $git clone https://github.com/albertbuchard/serve-it-quick.git
    $cd serve-it-quick
    $npm install
    $node serve

And voila!
Php server + router running on http://subdomainExample.localhost:8000

#Customize
The php router file is in lib/server/router.php. To customize the router you can change the subdomains :

1) Set your default subdomain, where http://localhost:8000 points to

    $defaultSubdomain = "subdomain-example";

2) Set all the valid subdomains. As default you have http://another-subdomain.localhost:8000/ also setup:

    $validSubdomains = array("subdomain-example",
      "another-subdomain");


3) By default the router will look for the subdomain _and the views_ in public/html/subdomain. Change that as needed:

    $pathToWebFolder = "public/html/".$subdomain."/";
    $pathToViews = "public/html/".$subdomain."/";

4) By default it looks for an index.php or index.html. An error is returned if the path does not contain an index file :

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

#Dependencies
node

node-php-server

php if you are on windows

#License
MIT 
