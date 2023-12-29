<?php

namespace App\Livewire;

use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookmarkData extends Component
{
    public function render()
    {
        return view('livewire.bookmark-data');
    }

    public function placeholder()
    {
        // return <<<HTML
        // <div style="display: flex; justify-content: center; align-items: center; height: 50vh;">
        // <svg xmlns="http://www.w3.org/2000/svg" width="110" height="110" viewBox="0 0 200 200"><circle fill="#FFF129" stroke="#FFF129" stroke-width="2" r="15" cx="40" cy="100"><animate attributeName="opacity" calcMode="spline" dur="2" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#FFF129" stroke="#FFF129" stroke-width="2" r="15" cx="100" cy="100"><animate attributeName="opacity" calcMode="spline" dur="2" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#FFF129" stroke="#FFF129" stroke-width="2" r="15" cx="160" cy="100"><animate attributeName="opacity" calcMode="spline" dur="2" values="1;0;1;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>
        // </div>

        // HTML;


        $output = '<ul class="movies-list">';
        $datas = Bookmarks::where('name_user', Auth::user()->name)->get();

        if(isset($datas)){
        foreach ($datas as $data) {
            $output .= <<<HTML
        <!-- return <<<HTML -->
        <!-- <ul class="movies-list"> -->
        <li>
            <div class="movie-card">

                <a>
                    <figure class="card-banner">
                        <img src="/assets/images/no-image.jpg" alt="poster">
                    </figure>
                </a>

                <div class="title-wrapper">
                    <div class="flex animate-pulse flex-row items-center h-full justify-center space-x-5">
                        <div class="flex flex-col space-y-3">
                            <div class="bg-gray-300 h-6 rounded-md" style="width: 170px; height: 20px;"></div>
                            <div class="bg-gray-300 h-6 rounded-md" style="width: 150px; height: 20px;"></div>
                        </div>
                    </div>

                    <time datetime="2022">
                        <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                    </time>
                </div>

                <div class="card-meta">
                    <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>

                    <div class="duration">
                        <time datetime="PT122M">
                            <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                        </time>
                    </div>

                    <div class="rating">
                        <div class="animate-pulse bg-gray-300 rounded-md" style="width: 50px; height: 20px;"></div>
                    </div>
                </div>

            </div>
        </li>
        <!-- </ul> -->
    HTML;
        }
        }

        $output .= '</ul>';

        return $output;
    }
}
