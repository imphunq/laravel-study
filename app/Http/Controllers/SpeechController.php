<?php

namespace App\Http\Controllers;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Illuminate\Http\Request;

class SpeechController extends Controller
{
    /**
     * Handle the audio request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filePath = "audio/test.wav";
        $file = file_get_contents(base_path($filePath));

        $encoding = AudioEncoding::LINEAR16;
        $sampleRateHertz = 16000;
        $languageCode = 'en-US';

        $config = (new RecognitionConfig)
                    ->setEncoding($encoding)
                    ->setSampleRateHertz($sampleRateHertz)
                    ->setLanguageCode($languageCode);

        $audio = (new RecognitionAudio)
                    ->setContent($file);

        $speechClient = new SpeechClient();
dd($speechClient);
        $response = $speechClient->recognize($config, $audio);

        // dd($response);
    }
}
