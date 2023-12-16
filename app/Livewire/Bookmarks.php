<?php

namespace App\Livewire;

use App\Models\Bookmarks as ModelsBookmarks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bookmarks extends Component
{
    public $isClicked = false;
    public $item_id;

    public function mount($item_id)
    {
        $this->$item_id = $item_id;

        $this->isClicked = ModelsBookmarks::where('name_user', Auth::user()->name)
            ->where('item_id', $this->item_id)
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
                ->where('item_id', $this->item_id)
                ->delete();
        } else {
            // if not exist on database, add to the database
            $addBookmarks = new ModelsBookmarks([
                'name_user' => Auth::user()->name,
                'item_id' => $this->item_id,
            ]);

            $addBookmarks->save();
        }

        // changing the button effect
        $this->isClicked = !$this->isClicked;

    }
}
