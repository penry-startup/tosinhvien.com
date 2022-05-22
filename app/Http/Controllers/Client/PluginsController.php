<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Major\MajorRepository;
use Illuminate\Http\Request;

class PluginsController extends Controller
{
    private $_majorRepo;

    public function __construct(MajorRepository $majorRepo)
    {
        $this->_majorRepo = $majorRepo;
    }

    public function calculateGraduateScore(Request $request)
    {
        $tab_name = $request->get('tab');

        if ($tab_name === 'result') {
            $score = (array) $request->get('score', []);
            $type  = (int) $request->get('type', '');
            if (count($score) === 7 && $type && in_array($type, [1, 2]) && $this->_checkScoreValid($score)) {
                $score = array_map('intval', $score);

                if ($score['tn'] > 5) {
                    // dd('ok');
                } else {
                    // dd('not ok');
                }

                $matrix_scores  = [
                    $this->_matrixFormat(array_keys(array_slice($score, 1, 3))),
                    $this->_matrixFormat(array_keys(array_slice($score, 4, 6))),
                ];

                $matrix_score1    = $this->_matrixScore($matrix_scores, 0, 1);
                $matrix_score2    = $this->_matrixScore($matrix_scores, 1, 0);
                $composite_matrix = array_merge($matrix_score1, $matrix_score2);

                dd($composite_matrix);

                // return view('client.plugins.calculate-graduate-score', compact('response'));
            } else {
                return redirect()->route('client.public.plugins.show.CalculateGraduateScore', ['tab' => 'tool']);
            }
        }

        return view('client.plugins.calculate-graduate-score');
    }

    private function _matrixFormat($matrix)
    {
        $matrix_format  = [
            'su'   => 'Lịch sử',
            'dia'  => 'Địa lí',
            'cd'   => 'Giáo dục công dân',
            'toan' => 'Toán',
            'van'  => 'Ngữ văn',
            'anh'  => 'Tiếng Anh',
            'ly'   => 'Vật lí',
            'hoa'  => 'Hóa học',
            'sinh' => 'Sinh học'
        ];
        return array_map(function($item) use ($matrix_format) {
            return $matrix_format[$item];
        }, $matrix);
    }

    private function _matrixScore($matrix_scores, $f_index, $l_index)
    {
        $matrixs_saved = [];
        $index_saved = null;
        foreach ($matrix_scores[$f_index] as $index => $matrix_score) {
            $index_saved = $index;
            $major[1]    = $matrix_scores[$f_index][$index_saved];
            foreach ($matrix_scores[$f_index] as $index2 => $matrix_score2) {
                if ($index2 !== $index_saved) {
                    $major[2] = $matrix_score2;
                    for ($i = 0; $i < 3; $i++) {
                        $major[3] = $matrix_scores[$l_index][$i];
                        $matrixs_saved[] = [$major[1], $major[2], $major[3]];
                    }
                }
            }
        }

        return $matrixs_saved;
    }

    private function _checkScoreValid($score)
    {
        foreach ($score as $key => $item) {
            $item = (int) $item;
            if ($key === 'tn' && $item < 0) {
                return false;
            }
            if ($key !== 'tn' && ($item < 0 || $item > 10)) {
                return false;
            }
        };

        return true;
    }
}
