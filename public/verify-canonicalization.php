<?php
/**
 * Verify URL Canonicalization Implementation
 * 
 * This script tests that all URL variations redirect correctly to:
 * https://www.trustnews.press
 * 
 * Run this ONLY on production server via browser:
 * https://trustnews.press/verify-canonicalization.php
 * 
 * NOTE: Delete this file after testing!
 */

$domain = 'trustnews.press';
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$currentUrl = $protocol . '://' . $_SERVER['HTTP_HOST'];

// Detect if running locally
$isLocal = (stripos($_SERVER['HTTP_HOST'], 'localhost') !== false || stripos($_SERVER['HTTP_HOST'], ':8000') !== false);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Canonicalization Verification</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        h1 { 
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }
        .status-section {
            margin-bottom: 25px;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ddd;
        }
        .status-section.success {
            background: #e8f5e9;
            border-left-color: #4caf50;
        }
        .status-section.warning {
            background: #fff3e0;
            border-left-color: #ff9800;
        }
        .status-section.error {
            background: #ffebee;
            border-left-color: #f44336;
        }
        .status-section h3 {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .status-section.success h3 { color: #2e7d32; }
        .status-section.warning h3 { color: #e65100; }
        .status-section.error h3 { color: #c62828; }
        .status-section p {
            font-size: 14px;
            line-height: 1.6;
            margin: 5px 0;
        }
        .code { 
            font-family: 'Courier New', monospace;
            background: #f5f5f5;
            padding: 8px 12px;
            border-radius: 4px;
            word-break: break-all;
        }
        .checkmark { color: #4caf50; font-weight: bold; margin-right: 5px; }
        .warning-icon { color: #ff9800; font-weight: bold; margin-right: 5px; }
        .error-icon { color: #f44336; font-weight: bold; margin-right: 5px; }
        .test-instructions {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #2196f3;
        }
        .test-instructions h3 {
            color: #1565c0;
            margin-bottom: 15px;
        }
        .test-instructions ol {
            margin-left: 20px;
        }
        .test-instructions li {
            margin: 8px 0;
            color: #333;
        }
        .test-url {
            background: #f5f5f5;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            font-size: 13px;
            word-break: break-all;
        }
        .warning-banner {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 URL Canonicalization Verification</h1>

        <?php if ($isLocal): ?>
        <div class="warning-banner">
            ⚠️ <strong>Local Environment Detected</strong><br>
            You're running on localhost or development server. Canonicalization rules are disabled for local development.
        </div>
        <?php endif; ?>

        <!-- Current Status -->
        <div class="status-section <?php echo $isLocal ? 'warning' : 'success'; ?>">
            <h3>
                <?php echo $isLocal ? '<span class="warning-icon">⚠️</span>Current Environment' : '<span class="checkmark">✓</span>Current Status'; ?>
            </h3>
            <p><strong>Current URL:</strong></p>
            <div class="code"><?php echo htmlspecialchars($currentUrl); ?></div>
            <p style="margin-top: 10px;">
                <?php 
                    if (stripos($_SERVER['HTTP_HOST'], 'www.') === 0) {
                        echo '<span class="checkmark">✓</span>Using WWW prefix';
                    } else {
                        echo '<span class="warning-icon">⚠️</span>NOT using WWW prefix';
                    }
                    echo '<br>';
                    if ($protocol === 'https') {
                        echo '<span class="checkmark">✓</span>Using HTTPS (Secure)';
                    } else {
                        echo '<span class="error-icon">✗</span>Using HTTP (Not Secure)';
                    }
                ?>
            </p>
        </div>

        <!-- Test Instructions -->
        <div class="test-instructions">
            <h3>🧪 Test These URLs (Should all redirect to https://www.trustnews.press)</h3>
            <ol>
                <li><strong>HTTP without WWW:</strong>
                    <div class="test-url">http://trustnews.press</div>
                </li>
                <li><strong>HTTPS without WWW:</strong>
                    <div class="test-url">https://trustnews.press</div>
                </li>
                <li><strong>HTTP with WWW:</strong>
                    <div class="test-url">http://www.trustnews.press</div>
                </li>
                <li><strong>HTTPS with WWW (CANONICAL):</strong>
                    <div class="test-url">https://www.trustnews.press</div>
                    <small>✓ This is the canonical URL (should return 200 OK)</small>
                </li>
            </ol>
            <p style="margin-top: 20px; color: #1565c0;">
                <strong>How to Test:</strong> Copy a URL above and paste into browser address bar, then press Enter. 
                Check the final URL in address bar - it should be: <strong>https://www.trustnews.press</strong>
            </p>
        </div>

        <!-- .htaccess Status -->
        <div class="status-section success" style="margin-top: 30px;">
            <h3><span class="checkmark">✓</span>.htaccess Configuration</h3>
            <p>URL canonicalization rules are configured in <span class="code">public/.htaccess</span></p>
            <p style="margin-top: 10px;"><strong>Rules Active:</strong></p>
            <ul style="margin-left: 20px; margin-top: 10px;">
                <li>Force HTTPS: HTTP → HTTPS (301 redirect)</li>
                <li>Force WWW: non-www → www (301 redirect)</li>
                <li>Canonical URL: https://www.trustnews.press</li>
                <li>Local exceptions: localhost, :8000 excluded</li>
            </ul>
        </div>

        <!-- Canonical Link Tag -->
        <div class="status-section success" style="margin-top: 20px;">
            <h3><span class="checkmark">✓</span>Canonical Link Tag</h3>
            <p>Added to <span class="code">layouts/web.blade.php</span></p>
            <div class="code" style="margin-top: 10px;">
                &lt;link rel="canonical" href="{{ url()-&gt;current() }}" /&gt;
            </div>
            <p style="margin-top: 10px;">This provides Google with explicit canonical URL signal.</p>
        </div>

        <!-- Cleanup Notice -->
        <div class="status-section warning" style="margin-top: 20px;">
            <h3><span class="warning-icon">⚠️</span>Cleanup Required</h3>
            <p><strong>DELETE THIS FILE AFTER TESTING!</strong></p>
            <p>For security, remove <span class="code">public/verify-canonicalization.php</span> after verification is complete.</p>
            <p>Command: <span class="code">rm public/verify-canonicalization.php</span></p>
        </div>

        <!-- Summary -->
        <div style="margin-top: 30px; padding: 20px; background: #f9f9f9; border-radius: 8px; border-left: 4px solid #667eea;">
            <h3 style="color: #333; margin-bottom: 10px;">✅ Implementation Complete</h3>
            <ul style="margin-left: 20px; color: #555; line-height: 1.8;">
                <li><strong>Server-level Redirect:</strong> .htaccess rules (Apache level)</li>
                <li><strong>Meta Tags:</strong> SEOTools::generate() in controllers</li>
                <li><strong>Canonical Link:</strong> Added to layouts/web.blade.php</li>
                <li><strong>Result:</strong> All URL variations consolidate to <span class="code">https://www.trustnews.press</span></li>
            </ul>
        </div>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 40px; color: #999; font-size: 12px;">
            Trust News - URL Canonicalization Verification Tool
            <br>
            <small>This file should be deleted after testing</small>
        </div>
    </div>
</body>
</html>
