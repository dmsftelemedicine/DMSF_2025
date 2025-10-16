<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class IconController extends Controller
{
    /**
     * Serve SVG icons from the public/icons directory
     *
     * @param string $category The icon category (e.g., 'ros')
     * @param string $filename The icon filename
     * @return Response
     */
    public function serve($category, $filename)
    {
        // Validate category (whitelist)
        $allowedCategories = ['ros']; // Add more categories as needed
        if (!in_array($category, $allowedCategories, true)) {
            abort(404);
        }

        // Validate filename to prevent directory traversal attacks
        if (!preg_match('/^[a-zA-Z0-9\-_]+\.svg$/', $filename)) {
            abort(404);
        }

        // Use realpath() to prevent path traversal - more secure than just file_exists
        $basePath = realpath(public_path("icons/{$category}"));
        $requestedPath = $basePath ? realpath($basePath . DIRECTORY_SEPARATOR . $filename) : false;

        // Ensure the file exists and is within the allowed directory
        if (!$basePath || !$requestedPath || strncmp($requestedPath, $basePath, strlen($basePath)) !== 0 || !is_file($requestedPath)) {
            abort(404);
        }

        // Handle 304 Not Modified response
        $requestIfModifiedSince = request()->header('If-Modified-Since');
        $lastModified = gmdate('D, d M Y H:i:s', filemtime($requestedPath)) . ' GMT';

        if ($requestIfModifiedSince === $lastModified) {
            return response('', 304)
                ->header('Last-Modified', $lastModified)
                ->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Generate ETag for browser caching (only if needed)
        $etag = '"' . md5_file($requestedPath) . '"';
        $requestEtag = request()->header('If-None-Match');

        if ($requestEtag === $etag) {
            return response('', 304)
                ->header('ETag', $etag)
                ->header('Last-Modified', $lastModified)
                ->header('Cache-Control', 'public, max-age=31536000, immutable');
        }

        // Read the file content
        $content = File::get($requestedPath);

        // Return response with security headers
        return response($content, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('X-Content-Type-Options', 'nosniff') // Prevent MIME sniffing
            ->header('Content-Security-Policy', "default-src 'none'; img-src 'self' data:; style-src 'unsafe-inline'; sandbox; base-uri 'none'; frame-ancestors 'none'; object-src 'none'; script-src 'none'")
            ->header('Cache-Control', 'public, max-age=31536000, immutable')
            ->header('ETag', $etag)
            ->header('Last-Modified', $lastModified);
    }

    /**
     * List all available icons in a category (optional - for debugging)
     *
     * @param string $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($category = 'ros')
    {
        // Only allow in local/development environments
        if (!app()->environment('local', 'development')) {
            abort(404);
        }

        $allowedCategories = ['ros'];
        if (!in_array($category, $allowedCategories, true)) {
            abort(404, 'Invalid icon category');
        }

        $path = public_path("icons/{$category}");
        
        if (!File::isDirectory($path)) {
            return response()->json(['icons' => []]);
        }

        $files = File::files($path);
        $icons = array_map(function ($file) {
            return $file->getFilename();
        }, $files);

        return response()->json([
            'category' => $category,
            'icons' => array_values($icons)
        ]);
    }
}
