<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
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

    public function pages($title)
    {
        try {
            return view("pages.$title");
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}
