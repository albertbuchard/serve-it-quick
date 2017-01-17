<?php
// Amazingly Superb Router v1.0
//
// By. Albert Buchard 2016
header("Access-Control-Allow-Origin: *");

// constants
$apiRerouting = "api/api.php";

// parse the url
$url = parse_url($_SERVER['REQUEST_URI']);

// find the subdomain
$subdomain = explode(".", $_SERVER['HTTP_HOST'])[0];

// set your default subdomain
$defaultSubdomain = "subdomain-example";

// check if the subdomain is valid else default it
$validSubdomains = array("subdomain-example",
  "another-subdomain");

if (!in_array($subdomain, $validSubdomains)) {
    $subdomain = $defaultSubdomain;
}

// Change the website directory as needed
chdir("public/html/".$subdomain."/");
$pathToWebFolder = "";
$pathToViews = "";

// Get the requested filename from URI
$filename = urldecode(basename($url["path"]));
$filepath = urldecode($pathToWebFolder.substr($url["path"], 1));


// Check if the call was made to the api with the api/noExtension/afterTheFile style
if (($apiRerouting !== "")&&(pathinfo($filename, PATHINFO_EXTENSION) === "")) {
    if (file_exists($apiRerouting)) {
        $apiString = $filepath;
        include $apiRerouting;
    } else {
        echo("Router Error: No api file found. ". $apiRerouting." not found !");
    }

    exit;
} elseif ((pathinfo($filename, PATHINFO_EXTENSION) === "")||($url["path"]=="/")) {
    // if no path was set or if api rerouting is set to '' with api style call, reroute to index
   if (file_exists($pathToViews."index.php")) {
       include $pathToViews."index.php";
   } elseif (file_exists($pathToViews."index.html")) {
       include $pathToViews."index.html";
   } else {
       echo("Router Error: No index file found. ". $pathToViews."index.php not found !");
   }
    exit;
}


// if an extension is provided - checks if file exists
if (!file_exists($filepath)) {
    var_dump(pathinfo($filename, PATHINFO_EXTENSION));
    echo("Error: ". $filepath ." not found !");
    exit;
}

// authorized files
$authorizedFileExt = array("PNG", "MAP", "JPG", "GIF", "WOFF2", "BABYLON", "OBJ", "SBSAR", "TGA");
$authorizedTextFileExt = array("PHP","TXT", "CSS", "CSV", "JS", "JSON", "MAP", "TEMPLATE", "HTML");


// css text file
if (strtoupper(pathinfo($filename, PATHINFO_EXTENSION)) == "CSS") {
    header('Content-Type: text/css');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit;
}

// Other text files
if (in_array(strtoupper(pathinfo($filename, PATHINFO_EXTENSION)), $authorizedTextFileExt)) {
    include $filepath;
    exit;
}

// MIME protocol for other files
if (in_array(strtoupper(pathinfo($filename, PATHINFO_EXTENSION)), $authorizedFileExt)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit;
}

// fallback error
$pathError = true;
if ($pathError) {
    var_dump(pathinfo($filename, PATHINFO_EXTENSION));
    echo("Error: invalid file extension !");
}
