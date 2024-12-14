<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Translate Integration</title>
    <style>
        /* Hide the Google logo */
        .goog-logo-link {
            display: none !important;
        }

        .goog-te-gadget {
            font-size: 0 !important;
        }

        /* Optionally adjust the font size for the dropdown */
        .goog-te-combo {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h1>My Web Page</h1>

    <p>Hello everybody! This is a sample page.</p>

    <p>Translate this page:</p>

    <!-- Google Translate Dropdown -->
    <div id="google_translate_element"></div>

    <!-- Google Translate Initialization -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ne',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

    <!-- Google Translate Script -->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <p>Choose a language from the dropdown above to translate this page.</p>
</body>

</html>
