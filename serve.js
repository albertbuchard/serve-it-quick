var phpServer = require('node-php-server');

// Create a PHP Server 
phpServer.createServer({
  port: 8000,
  hostname: 'localhost',
  base: '.',
  keepalive: false,
  open: false,
  bin: 'php',
  router: 'lib/server/router.php'
});