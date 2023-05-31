<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index()
    {
        return view("welcome", [
            "downloader_name" => "Youtube",
            "faqs" => [
                ["question" => __("Question 1"), "answer" => __("Answer 1")],
                ["question" => __("Question 2"), "answer" => __("Answer 2")],
                ["question" => __("Question 3"), "answer" => __("Answer 3")],
                ["question" => __("Question 4"), "answer" => __("Answer 4")],
                ["question" => __("Question 5"), "answer" => __("Answer 5")],
                ["question" => __("Question 6"), "answer" => __("Answer 6")],
                ["question" => __("Question 7"), "answer" => __("Answer 7")],
                ["question" => __("Question 8"), "answer" => __("Answer 8")],
                ["question" => __("Question 9"), "answer" => __("Answer 9")],
            ],
            "updates" => [
                ["title" => __("UPDATE (3 April 2023):"), "description" => __("We addressed an issue that caused the downloader to keep loading and then fails, as well as some minor bugs you reported.")],
                ["title" => __("UPDATE (3 April 2023):"), "description" => __("We addressed an issue that caused the downloader to keep loading and then fails, as well as some minor bugs you reported.")]
            ]
        ]);
    }

    public function get_video_info(Request $request)
    {
        $id = null;
        if (str_contains($request->url, 'youtube.com')&&str_contains($request->url, 'watch')) {
            $url = parse_url($request->url);
            $params = null;
            parse_str($url['query'], $params);
            $id = $params['v'];
        }
        if (str_contains($request->url, 'youtu.be')) {
            $id = explode('youtu.be/', $request->url)[1];
        }
        if (str_contains($request->url, 'shorts')) {
            $id = explode('?', explode('shorts/', $request->url)[1])[0];
        }

        if ($id) {
            $data = json_decode($this->getVideoInfo($id));
            return response(['streaming_data' => ($data->streamingData), 'video_details' => ($data->videoDetails)]);
        }

        return response('Please enter correct youtube video url', 404);
    }

    private function getVideoInfo($video_id)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://www.youtube.com/youtubei/v1/player?key=AIzaSyAO_FJ2SlqU8Q4STEHLGCilw_Y9_11qcW8');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{  "context": {    "client": {      "hl": "en",      "clientName": "WEB",      "clientVersion": "2.20210721.00.00",      "clientFormFactor": "UNKNOWN_FORM_FACTOR",   "clientScreen": "WATCH",      "mainAppWebInfo": {        "graftUrl": "/watch?v=' . $video_id . '",           }    },    "user": {      "lockedSafetyMode": false    },    "request": {      "useSsl": true,      "internalExperimentFlags": [],      "consistencyTokenJars": []    }  },  "videoId": "' . $video_id . '",  "playbackContext": {    "contentPlaybackContext": {        "vis": 0,      "splay": false,      "autoCaptionsDefaultOn": false,      "autonavState": "STATE_NONE",      "html5Preference": "HTML5_PREF_WANTS",      "lactMilliseconds": "-1"    }  },  "racyCheckOk": false,  "contentCheckOk": false}');
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    function download_helper(Request $request)
    {
        $filename = str_replace(',', '_', str_replace(' ', '_', $request->filename)) . '.' . $request->ext;

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment;filename=$filename");
        header("Content-Transfer-Encoding: binary");

        readfile($request->url);
    }
}
