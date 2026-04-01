<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminSettingsController extends Controller
{
    /**
     * Save admin settings to JSON file
     */
    public function saveSettings(Request $request)
    {
        try {
            $settings = $request->all();
            
            // Ensure storage/app directory exists
            $storagePath = storage_path('app');
            if (!File::isDirectory($storagePath)) {
                File::makeDirectory($storagePath, 0755, true);
            }

            $settingsPath = storage_path('app/settings.json');
            
            // Write settings to JSON file with pretty print
            $json = json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            
            if ($json === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'JSON encoding failed: ' . json_last_error_msg()
                ], 500);
            }
            
            $written = File::put($settingsPath, $json);
            
            if (!$written) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to write to file. Check file permissions on storage/app directory.'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Settings saved successfully',
                'path' => $settingsPath
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving settings: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Get admin settings from JSON file
     */
    public function getSettings()
    {
        try {
            $settingsPath = storage_path('app/settings.json');
            
            if (File::exists($settingsPath)) {
                $content = File::get($settingsPath);
                $settings = json_decode($content, true);
                
                if ($settings === null) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid JSON in settings file'
                    ], 400);
                }
                
                return response()->json([
                    'success' => true,
                    'data' => $settings
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Settings file not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error reading settings: ' . $e->getMessage()
            ], 500);
        }
    }
}
