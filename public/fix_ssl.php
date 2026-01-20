<?php
/**
 * Run this file on your server root.
 * It will help diagnose and fix common SSL / Laravel config issues
 */



echo "<hr><h2>Step 2: Clear Laravel Cache</h2>";
echo "<pre>";
passthru('php artisan config:clear');
passthru('php artisan cache:clear');
passthru('php artisan route:clear');
passthru('php artisan view:clear');
echo "</pre>";

echo "<hr><h2>Step 3: Check SSL certificate</h2>";
$domain = 'www.trustnews.press';
$port = 443;
$cmd = "echo | openssl s_client -connect $domain:$port 2>/dev/null | openssl x509 -noout -dates";
echo "<pre>";
passthru($cmd);
echo "</pre>";
echo "If you see 'notBefore' and 'notAfter', SSL exists. If not, SSL is missing or invalid.<br>";

echo "<hr><h2>Step 4: Firewall / Cloudflare IP check</h2>";
echo "Make sure your server allows Cloudflare IPs: <a href='https://www.cloudflare.com/ips'>Cloudflare IP list</a><br>";
echo "If you have iptables or CSF, whitelist these IP ranges.<br>";

echo "<hr><h2>Step 5: Optional Fix</h2>";
echo "1. If SSL is missing, install Let's Encrypt or Cloudflare Origin Certificate.<br>";
echo "2. Set Cloudflare SSL mode to 'Full' if using self-signed certificate.<br>";
echo "3. Restart web server after SSL fix (Apache/Nginx).<br>";
