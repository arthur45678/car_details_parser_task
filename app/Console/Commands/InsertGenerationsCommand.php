<?php

namespace App\Console\Commands;

use App\Models\CarModel;
use App\Models\Generation;
use DiDom\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InsertGenerationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generations:insert';
    protected $description = 'Import models';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', -1);
        $this->info('Importing car generations...');
        Generation::query()->delete();

        $client = new \GuzzleHttp\Client();
        $document = new Document();

        foreach (CarModel::cursor() as $carmodel) {
            $file = $this->get_html($carmodel->uri,$client);
            $document->loadHtml($file);
            $this->get_generations($document,$carmodel);

        }
        $this->info('Car generations imported successfully.');

    }

    public function get_generations(Document $document, $car_model)
    {
        $genertions_data = [];
        $findMarkets = $document->find('.css-pyemnz.e1ei9t6a4');
        foreach ($findMarkets as $findedMarket) {

            if ($findedMarket !== null) {
                $market = $this->get_market($findedMarket);
                $car_models = $document->find('.css-btm8d5.e1ei9t6a0');
                foreach ($car_models as $key => $carmodel) {
                    $attributes = $this->get_generation_attributes($carmodel);
                    if($attributes['title']){
                        $url_part = $carmodel->first('div[data-ga-stats-name="generations_outlet_item"] a.e1ei9t6a1.css-1x6lzas.ezhoka60')->attr('href');
                        $img_path = $carmodel->first('div[data-ga-stats-name="generations_outlet_item"] a img')->attr('src');
                        $datas['img_path'] = $img_path ? $img_path : null;
                        $datas['market'] = $market;
                        $datas['uri'] = $car_model->uri . $url_part;
                        $datas['carmodel_id'] = $car_model->id;
                        $datas['title'] = $attributes['title'];
                        $datas['period'] = $attributes['period'];
                        $genertions_data[] = $datas;
                    }

                }
            }

        }

        Generation::insert($genertions_data);


    }
    public function get_html($url, \GuzzleHttp\Client $client)
    {
        $response = $client->get($url);
        return $response->getBody()->getContents();
    }

    public function get_generation_attributes($carmodel)
    {
        $str = false;
        $title_element = $carmodel->first('.css-c4i2qy');
        if($title_element){
            $str = $title_element->attr('alt');
            $altAttribute = $title_element->getAttribute('alt');
        }
        $title_element = $carmodel->first('.css-c4i2qy');
        if($str){

            return [
                'title' => explode("\r\n",$str)[0],
                'period' => explode("\r\n",$str)[1],
            ];
        }
        return false;
    }

    public function get_market($document)
    {
        $market = $document->first('div[id]');
        if ($market !== null) {
            $market = $market->attr('id');
            return $market;
        }
        return false;
    }
}
