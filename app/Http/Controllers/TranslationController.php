<?php

namespace App\Http\Controllers;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function translate(Request $request)
    {
        // Retrieve the array of text nodes and target language from the request
        $texts = $request->input('text'); // Array of texts
        $targetLanguage = $request->input('language', 'en'); // Default to English

        // Initialize the Google Translate Client
        $translate = new TranslateClient([
            'keyFilePath' => storage_path('app/service-accounts/bharatpur-smart-city-web-app-486130839b19.json'),
        ]);

        // Translate each text in the array
        $translatedTexts = array_map(function ($text) use ($translate, $targetLanguage) {
            $result = $translate->translate($text, ['target' => $targetLanguage]);
            return $result['text']; // Extract the translated text
        }, $texts);

        // Return the translated texts as a JSON response
        return response()->json([
            'translatedTexts' => $translatedTexts
        ]);
    }
}
