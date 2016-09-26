#serveItQuick
A node-php server platform with the simplest of custom router for development.
!! Works on Chrome only for now !!

#Install
First, you need node.js:

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

4) By default it looks for an index.html if the path does not contain a file:

    if ($url["path"]=="/") {
      include $pathToViews."index.html";
      exit;
    } 

#Dependencies
node
node-php-server
php if you are on windows

#License
MIT