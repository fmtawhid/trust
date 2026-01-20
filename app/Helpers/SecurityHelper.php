<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Add security attributes to external links
     * 
     * @param string $html
     * @return string
     */
    public static function secureExternalLinks($html)
    {
        // Add rel="noopener noreferrer" to all target="_blank" links that don't already have it
        $pattern = '/(<a\s+(?:[^>]*?\s+)?target=["\']_blank["\']\s*(?!.*rel=)[^>]*?)>/i';
        $replacement = '$1 rel="noopener noreferrer">';
        
        return preg_replace($pattern, $replacement, $html);
    }

    /**
     * Convert external links to secure links
     * 
     * @param string $html
     * @return string
     */
    public static function makeExternalLinksSecure($html)
    {
        // Find all anchor tags with target="_blank"
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOXMLHEADER);

        $links = $dom->getElementsByTagName('a');
        foreach ($links as $link) {
            if ($link->getAttribute('target') === '_blank') {
                $rel = $link->getAttribute('rel');
                if (strpos($rel, 'noopener') === false) {
                    $link->setAttribute('rel', trim($rel . ' noopener noreferrer'));
                }
            }
        }

        return $dom->saveHTML();
    }
}
