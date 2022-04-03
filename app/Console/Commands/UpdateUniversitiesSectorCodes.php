<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;
use Symfony\Component\DomCrawler\Crawler;

class UpdateUniversitiesSectorCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:universitiessectorcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This crontab is run monthly, update data universities and data major';

    private $const = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->const = (object) [];
        $this->const->csv_folder   = storage_path('csv/');
        $this->const->universities = (object) [
            'csv_name' => 'universities.csv',
            'list'     => [],
        ];

        $this->const->majors = (object) [
            'csv_name' => 'majors.csv',
            'list'     => [],
        ];

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');

        try {
            $cities = json_decode(file_get_contents(app_path('../database/json/cities.json')), true);
            foreach ($cities as $city_id => $city) {
                $this->const->universities->list = array_merge($this->const->universities->list, self::_formatDataUniv($city_id));
            }

            // foreach ($this->const->universities->list as $key => $univ) {
            //     $univData = self::_formatDataUnivPage($univ);

            //     $this->const->universities->list[$key]['address'] = !empty($univData['address']) ? $univData['address'] : '';
            //     $this->const->universities->list[$key]['phone']   = !empty($univData['phone'])   ? $univData['phone']   : '';
            //     $this->const->universities->list[$key]['website'] = !empty($univData['website']) ? $univData['website'] : '';
            // }

            self::_clearCsvUnivFile();
            self::_updateUnivsCsv();
        } catch (\Throwable $e) {
            dump($e);
            return;
        }

        // Insert universities database
        \DB::beginTransaction();
        try {
            self::_insertUnivDB();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            dump($e);
            return;
        }

        try {
            self::_formatDataMajor();
            self::_clearCsvMajorFile();
            self::_updateMajorsCsv();
        } catch (\Throwable $e) {
            dump($e);
            return;
        }

        // Insert majors database
        \DB::beginTransaction();
        try {
            self::_insertMajorDB();
            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            dump($e);
            return;
        }
    }

    private function _formatDataMajor()
    {
        \App\Models\University::select('id', 'code', 'name')
            ->get()
            ->chunk(100)
            ->each(function($chunk) {
                LazyCollection::make(function() use ($chunk) {
                    foreach ($chunk as $item) {
                        yield $item;
                    }
                })->each(function($item) {
                    $majorsData = self::_crawlMajorData($item->id, $item->name, $item->code);
                    if (count($majorsData) > 0) {
                        $this->const->majors->list = array_merge($this->const->majors->list , $majorsData);
                    }
                });
            });
    }

    private function _crawlMajorData($univId, $univName, $univCode)
    {
        $slugUnivName  = \Str::slug($univName, '-');
        $urlCrawlMajor = "https://diemthi.tuyensinh247.com/diem-chuan/{$slugUnivName}-{$univCode}.html";
        $crawler       = self::_crawlData($urlCrawlMajor);
        $crawlerData   = [
            'thpt_score'  => [],
            'hocba_score' => [],
            'dgnl_score'  => []
        ];

        $crawler->filter('#one tr.bg_white')->each(function(Crawler $node) use (&$crawlerData) {
            $node->filter('td')->each(function(Crawler $node) use (&$crawlerData) {
                $crawlerData['thpt_score'][] = $node->text();
            });
        });

        $crawler->filter('#two tr.bg_white')->each(function(Crawler $node) use (&$crawlerData) {
            $node->filter('td')->each(function(Crawler $node) use (&$crawlerData) {
                $crawlerData['hocba_score'][] = $node->text();
            });
        });

        $crawler->filter('#three tr.bg_white')->each(function(Crawler $node) use (&$crawlerData) {
            $node->filter('td')->each(function(Crawler $node) use (&$crawlerData) {
                $crawlerData['dgnl_score'][] = $node->text();
            });
        });

        $majorThptList   = self::_getDataMajor($univId, $crawlerData, 'thpt_score');
        $majorHocbaList  = self::_getDataMajor($univId, $crawlerData, 'hocba_score');
        $majorDgnlList   = self::_getDataMajor($univId, $crawlerData, 'dgnl_score');

        $syncMajor = $majorThptList;
        $syncMajor = array_map(function($item) use ($majorHocbaList) {
            if (@$majorHocbaList[$item['key']]) {
                $arrNew = array_merge($item, ['hocba_score' => $majorHocbaList[$item['key']]['hocba_score']]);
                return $arrNew;
            } else {
                return $item;
            }
        }, $syncMajor);
        $syncMajor = array_map(function($item) use ($majorDgnlList) {
            if (@$majorDgnlList[$item['key']]) {
                $arrNew = array_merge($item, ['dgnl_score' => $majorDgnlList[$item['key']]['dgnl_score']]);
                return $arrNew;
            } else {
                return $item;
            }
        }, $syncMajor);

        return array_values($syncMajor);
    }

    private function _getDataMajor($univId, $major, $scoreType) {
        $major      = $major[$scoreType];
        $majorsList = [];
        $index      = 0;
        while($index < count($major)) {
            $majorsList[self::_getKeyMajor($major[$index + 1], $major[$index + 3])] = [
                'key'           => self::_getKeyMajor($major[$index + 1], $major[$index + 3]),
                'code'          => $major[$index + 1],
                'name'          => $major[$index + 2],
                'subject_group' => $major[$index + 3],
                'thpt_score'    => $scoreType === 'thpt_score'  ? $major[$index + 4] : null,
                'hocba_score'   => $scoreType === 'hocba_score' ? $major[$index + 4] : null,
                'dgnl_score'    => $scoreType === 'dgnl_score'  ? $major[$index + 4] : null,
                'university_id' => $univId
            ];
            $index += 6;
        }
        return $majorsList;
    }

    private function _updateUnivsCsv()
    {
        $fileUnivCsv  = "{$this->const->csv_folder}{$this->const->universities->csv_name}";
        $handleWriter = fopen($fileUnivCsv, 'w');
        $date         = now();

        LazyCollection::make(function() {
            foreach ($this->const->universities->list as $line) {
                yield $line;
            }
        })->each(function($line) use ($handleWriter, $date) {
            fputcsv($handleWriter, [
                'name'       => self::_formatDataSaveCsv($line['name']),
                'code'       => "'".self::_formatDataSaveCsv($line['code'])."'",
                'city_id'    => self::_formatDataSaveCsv($line['city_id']),
                'type'       => self::_formatDataSaveCsv($line['type']),
                'address'    => NULL,
                'phone'      => NULL,
                'website'    => NULL,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        });
    }

    private function _updateMajorsCsv()
    {
        $fileMajorCsv = "{$this->const->csv_folder}{$this->const->majors->csv_name}";
        $handleWriter = fopen($fileMajorCsv, 'w');
        $date         = now();

        LazyCollection::make(function() {
            foreach ($this->const->majors->list as $line) {
                yield $line;
            }
        })->each(function($line) use ($handleWriter, $date) {
            fputcsv($handleWriter, [
                'code'          => self::_formatDataSaveCsv($line['code']),
                'name'          => self::_formatDataSaveCsv($line['name']),
                'subject_group' => self::_formatDataSaveCsv($line['subject_group']),
                'thpt_score'    => (float) self::_formatDataSaveCsv($line['thpt_score']),
                'hocba_score'   => (float) self::_formatDataSaveCsv($line['hocba_score']),
                'dgnl_score'    => (float) self::_formatDataSaveCsv($line['dgnl_score']),
                'university_id' => (float) self::_formatDataSaveCsv($line['university_id']),
                'created_at'    => $date,
                'updated_at'    => $date
            ]);
        });
    }

    private function _formatDataUnivPage($univ)
    {
        $slugUnivName = \Str::slug($univ['name'], '-');
        $urlCrawlUniv = "https://diemthi.tuyensinh247.com/thong-tin-{$slugUnivName}-{$univ['code']}.html";
        $crawler      = self::_crawlData($urlCrawlUniv);
        $crawlData    = [];

        $crawler->filter('.main .col-center .col-513 .news-page')->each(
            function(Crawler $node) use (&$crawlData) {
                $node->filter('p')->each(function(Crawler $node) use (&$crawlData) {
                    $crawlData[] = $node->text();
                });
            }
        );

        $dataFormat = [];

        foreach ($crawlData as $item) {
            $arr = explode(':', $item);
            switch ($arr[0]) {
                case 'Địa chỉ':
                    $dataFormat['address'] = $arr[1];
                    break;
                case 'Website':
                    if (count($arr) === 3) {
                        $dataFormat['website'] = $arr[1] . ':' . $arr[2];
                    }
                    break;
                case 'ĐT':
                    $dataFormat['phone'] = $arr[1];
                    break;
                default:
            }
        }

        return $dataFormat;
    }

    private function _formatDataUniv($city_id)
    {
        $urlCrawlUniv = "https://diemthi.tuyensinh247.com/danh-sach-truong-dai-hoc-cao-dang.html?city={$city_id}";
        $crawler      = self::_crawlData($urlCrawlUniv);
        $list         = [];
        $crawler->filter('.code-shol table tr')->each(
            function(Crawler $node) use (&$list) {
                $node->filter('td')->each(function(Crawler $node) use (&$list) {
                    $code = $node->first()->filter('a')->text();
                    $list[] = $code;
                });
            }
        );

        $list = array_filter($list, function($item) {
            return !!strlen($item);
        });

        $listNew = [];
        $index   = 0;
        while($index < count($list)) {
            $isColleges = str_contains($list[$index+1], 'Cao Đẳng');
            $listNew[] = [
                'name'    => $list[$index+1],
                'code'    => $list[$index],
                'city_id' => $city_id,
                'type'    => $isColleges ? config('constants.university_type.key.CD') : config('constants.university_type.key.DH')
            ];
            $index += 2;
        }

        return $listNew;
    }

    private function _crawlData($url)
    {
        $client  = new Client();
        $crawler = $client->request('GET', $url);

        return $crawler;
    }

    private function _getKeyMajor($code, $subjectGrp)
    {
        return \Str::slug($code . '-' . $subjectGrp, '-');
    }

    private function _clearCsvUnivFile()
    {
        system("rm -f {$this->const->csv_folder}{$this->const->universities->csv_name}");
    }

    private function _clearCsvMajorFile()
    {
        system("rm -f {$this->const->csv_folder}{$this->const->majors->csv_name}");
    }

    private function _insertUnivDB()
    {
        $file = fopen("{$this->const->csv_folder}{$this->const->universities->csv_name}", 'r');
        $values = [];
        $idOrder = 1;

        while (!feof($file)) {
            $line = fgets($file);

            if (empty($line)) continue;

            $line = self::_getRowDataCsv($line);
            array_unshift($line, $idOrder++);

            $line = self::_getFormattedRow($line);
            $values[] = "({$line})";
        }

        $columns = ['`id`', '`name`', '`code`', '`city_id`', '`type`', '`address`', '`phone`', '`website`', '`created_at`', '`updated_at`'];
        self::_insertToDB('universities', $values, $columns);
        fclose($file);
    }

    private function _insertMajorDB()
    {
        $file = fopen("{$this->const->csv_folder}{$this->const->majors->csv_name}", 'r');
        $values = [];
        $idOrder = 1;

        while (!feof($file)) {
            $line = fgets($file);

            if (empty($line)) continue;

            $line = self::_getRowDataCsv($line);
            $row = [
                'id'   => $idOrder++,
                'code' => "'".str_replace("'", "", $line[0])."'",
                'name' => "'".str_replace("'", "", $line[1])."'",
                'subject_group' => "'".str_replace("'", "", $line[2])."'",
                'thpt_score'    => (float) $line[3],
                'hocba_score'   => (float) $line[4],
                'dgnl_score'    => (float) $line[5],
                'university_id' => $line[6],
                'created_at'    => $line[7],
                'updated_at'    => $line[8]
            ];
            $row = self::_getFormattedRow($row);
            $values[] = "({$row})";
        }

        $columns = ['`id`', '`code`', '`name`', '`subject_group`', '`thpt_score`', '`hocba_score`', '`dgnl_score`', '`university_id`', '`created_at`', '`updated_at`'];
        self::_insertToDB('majors', $values, $columns);
        fclose($file);
    }

    private function _getRowDataCsv($line)
    {
        $line = preg_replace('/\"/', "'", $line);
        $line = str_replace("\n", "", $line);
        $line = str_replace(", ", "__", $line);
        $line = explode(",", $line);
        $line = array_map(function($item) {
            return str_replace("__", ", ", $item);
        }, $line);
        return $line;
    }

    private function _getFormattedRow($row)
    {
        $row = array_values($row);
        foreach ($row as $key => &$value) {
            if (!$value) {
                $value = 'null';
            }
        }
        $row = implode(",", $row);

        return $row;
    }

    private function _formatDataSaveCsv($data)
    {
        $data = explode(' ', $data);
        $data = implode('', array_filter($data, function($item) {
            return !!$item;
        }));
        $data = trim($data);
        $data = preg_replace('/\"/', "'", $data);
        $data = str_replace("\n", "", $data);

        return strlen($data) > 0 ? $data : NULL;
    }

    private function _insertToDB($table, $values, $columns)
    {
        \DB::table($table)->delete();
        $columns      = implode(",", $columns);
        $rows         = implode(",", $values);
        $query        = "INSERT INTO `{$table}` ({$columns}) VALUES";
        $insertQuery  = "{$query} {$rows};";
        \DB::statement($insertQuery);
    }
}
