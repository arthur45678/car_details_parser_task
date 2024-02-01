<?php

namespace App\Console\Commands;

use App\Models\CarModel;
use DiDom\Document;
use Illuminate\Console\Command;

class InsertModelsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carmodels:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', -1);
        $url = 'https://www.drom.ru/catalog/audi/';

        $client = new \GuzzleHttp\Client();
        $document = new Document();

        $file = $this->get_html($url,$client);
        $document->loadHtml($file);

        $models_data = [];

        $models = $document->find('a.e64vuai0.css-1i48p5q.e104a11t0');
        foreach ($models as $a) {
            $models_data[] = [
                'title' => explode('.',$a->text())[0],
                'uri' => $a->attr('href'),
                'brand' => 'Audi'
            ];

        }
        $this->info('Importing car models...');
        CarModel::query()->delete();
        CarModel::insert($models_data);
        $this->info('Car models imported successfully.');

    }

    public function get_html($url, \GuzzleHttp\Client $client): string
    {
        $response = $client->get($url);
        return $response->getBody()->getContents();
    }
}
