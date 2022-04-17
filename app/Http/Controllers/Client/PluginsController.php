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

                return view('client.plugins.calculate-graduate-score', compact('response'));
            } else {
                dd('down ok');
                return redirect()->route('client.public.plugins.show.CalculateGraduateScore', ['tab' => 'tool']);
            }
        }

        return view('client.plugins.calculate-graduate-score');
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
