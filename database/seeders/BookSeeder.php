<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    protected $api_url;

    public function __construct()
    {
        $this->api_url = 'https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $get_data = $this->callAPI('GET', $this->api_url, false);
        $response = json_decode($get_data, true);
        $BookList = $response['items'];

        foreach ($BookList as $b) {
            Book::updateOrCreate(
                [
                    'book_id'   =>  $b['id'],
                ],
                [
                    'book_id'           =>  $b['id'],
                    'small_thumbnail'   => $b['volumeInfo']['imageLinks']['smallThumbnail'],
                    'thumbnail'         => $b['volumeInfo']['imageLinks']['thumbnail'],
                    'title'             => $b['volumeInfo']['title'],
                    'subtitle'          => isset($b['volumeInfo']['subtitle']) ? $b['volumeInfo']['subtitle'] : NULL,
                    'authors'           => $b['volumeInfo']['authors'][0],
                ],
            );
        }
    }

    private function callAPI($method, $url, $data)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: AppRinger',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }
}
