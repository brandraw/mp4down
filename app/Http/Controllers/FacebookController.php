<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookController extends Controller
{
    public function index()
    {
        return view("welcome", [
            "downloader_name" => "Facebook",
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

    public function render_download(Request $request)
    {

        header('Content-Type: application/json');

        $msg = [];

        try {
            $url = $request->url;

            if (empty($url)) {
                throw new Exception('Please provide the URL', 1);
            }

            $headers = [
                'sec-fetch-user'            => '?1',
                'sec-ch-ua-mobile'          => '?0',
                'sec-fetch-site'            => 'none',
                'sec-fetch-dest'            => 'document',
                'sec-fetch-mode'            => 'navigate',
                'cache-control'             => 'max-age=0',
                'authority'                 => 'www.facebook.com',
                'upgrade-insecure-requests' => '1',
                'accept-language'           => 'en-GB,en;q=0.9,tr-TR;q=0.8,tr;q=0.7,en-US;q=0.6',
                'sec-ch-ua'                 => '"Google Chrome";v="89", "Chromium";v="89", ";Not A Brand";v="99"',
                'user-agent'                => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
                'accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'cookie'                    => 'sb=Rn8BYQvCEb2fpMQZjsd6L382; datr=Rn8BYbyhXgw9RlOvmsosmVNT; c_user=100003164630629; _fbp=fb.1.1629876126997.444699739; wd=1920x939; spin=r.1004812505_b.trunk_t.1638730393_s.1_v.2_; xs=28%3A8ROnP0aeVF8XcQ%3A2%3A1627488145%3A-1%3A4916%3A%3AAcWIuSjPy2mlTPuZAeA2wWzHzEDuumXI89jH8a_QIV8; fr=0jQw7hcrFdas2ZeyT.AWVpRNl_4noCEs_hb8kaZahs-jA.BhrQqa.3E.AAA.0.0.BhrQqa.AWUu879ZtCw',
            ];


            $client = Http::withHeaders($headers);
            $data = $client->get($url);

            $msg['success'] = true;

            $msg['id'] = $this->generateId($url);
            $msg['title'] = $this->getTitle($data);
            $msg['description'] = $this->getDescription($data);
            $msg['thumb'] = $this->getImage($data);
            $msg['links']=[];
            if ($sdLink = $this->getSDLink($data)) {
                array_push($msg['links'], [
                    'title'=> 'Download Low Quality',
                    'value'=> $sdLink
                ]);
            }

            if ($hdLink = $this->getHDLink($data)) {
                array_push($msg['links'], [
                    'title'=> 'Download High Quality',
                    'value'=> $hdLink
                ]);
            }
        } catch (Exception $e) {
            $msg['success'] = false;
            $msg['message'] = $e->getMessage();
        }

        return response(json_encode($msg));
    }


    private function generateId($url)
    {
        $id = '';
        if (is_int($url)) {
            $id = $url;
        } elseif (preg_match('#(\d+)/?$#', $url, $matches)) {
            $id = $matches[1];
        }

        return $id;
    }

    private function cleanStr($str)
    {
        $tmpStr = "{\"text\": \"{$str}\"}";

        return json_decode($tmpStr)->text;
    }

    private function getSDLink($curl_content)
    {
        $regexRateLimit = '/playable_url":"([^"]+)"/';

        if (preg_match($regexRateLimit, $curl_content, $match)) {
            return $this->cleanStr($match[1]);
        } else {
            return false;
        }
    }

    private function getHDLink($curl_content)
    {
        $regexRateLimit = '/playable_url_quality_hd":"([^"]+)"/';

        if (preg_match($regexRateLimit, $curl_content, $match)) {
            return $this->cleanStr($match[1]);
        } else {
            return false;
        }
    }

    private function getTitle($curl_content)
    {
        $title = null;
        if (preg_match('/<title>(.*?)<\/title>/', $curl_content, $matches)) {
            $title = $matches[1];
        } elseif (preg_match('/title id="pageTitle">(.+?)<\/title>/', $curl_content, $matches)) {
            $title = $matches[1];
        }

        return $this->cleanStr($title);
    }

    private function getDescription($curl_content)
    {
        if (preg_match('/span class="hasCaption">(.+?)<\/span>/', $curl_content, $matches)) {
            return $this->cleanStr($matches[1]);

        } elseif (preg_match('/savable_description":{"text":([^"]+)"/', $curl_content, $matches)) {
            return $this->cleanStr($matches[1]);
        }

        return "no description found";
    }
    private function getImage($curl_content)
    {
        if (preg_match('/preferred_thumbnail":{"image":{"uri":"([^"]+)"/', $curl_content, $matches)) {
            return $this->cleanStr($matches[1]);
        }

        return false;
    }
}
