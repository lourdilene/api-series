<?php

namespace App\Http\Controllers;

use App\Episode;

class EpisodesController extends BaseController
{
    public function __construct()
    {
        $this->classe = Episode::class;
    }
    
    public function searchBySeries(int $serieId)
    {
        $episodes = Episode::query()
            ->where('serie_id', $serieId)
            ->get();

        return $episodes;
    }
}
