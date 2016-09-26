<? 
// Amazingly Superb Router v1.0
//
// By. Albert Buchard 2016
header("Access-Control-Allow-Origin: *");

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
$pathToWebFolder = "public/html/".$subdomain."/"; 
$pathToViews = "public/html/".$subdomain."/";

// Check if view requested
if ($url["path"]=="/") {
  include $pathToViews."index.html";
  exit;
} 

// Get the requested filename from URI
$filename = urldecode(basename($url["path"]));
$filepath = urldecode($pathToWebFolder.substr($url["path"], 1));


// check if file exists
if (!file_exists($filepath)) {
  var_dump(pathinfo($filename, PATHINFO_EXTENSION));
  echo("Error: ". $filepath ." not found !");
  exit;
} 

// authorized files
$authorizedFileExt = array("PNG", "MAP", "JPG", "GIF", "WOFF2", "BABYLON", "OBJ", "SBSAR", "TGA");
$authorizedTextFileExt = array("TXT", "CSS", "CSV", "JS", "JSON", "MAP", "TEMPLATE", "HTML");


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

// generic text file
if (in_array(strtoupper(pathinfo($filename, PATHINFO_EXTENSION)), $authorizedTextFileExt)) {
  include $filepath;
  exit;
}

// non generic or specific text file
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


?>