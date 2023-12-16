<?php

namespace App\Livewire;

use App\Models\Bookmarks as ModelsBookmarks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bookmarks extends Component
{
    public $isClicked = false;
    public $id_movie;

    public function mount($id_movie)
    {
        $this->id_movie = $id_movie;

        $this->isClicked = ModelsBookmarks::where('name_user', Auth::user()->name)
            ->where('id_movie', $this->id_movie)
            ->exists();
    }

    public function render()
    {
        return view('livewire.bookmarks');
    }

    public function bookmark(){
        if ($this->isClicked) {
            // if alr exist database, gonna removed it from database
            ModelsBookmarks::where('name_user', Auth::user()->name)
                ->where('id_movie', $this->id_movie)
                ->delete();
        } else {
            // if not exist on database, add to the database
            $addBookmarks = new ModelsBookmarks([
                'name_user' => Auth::user()->name,
                'id_movie' => $this->id_movie,
            ]);

            $addBookmarks->save();
        }

        // changing the button effect
        $this->isClicked = !$this->isClicked;

    }
}
