<?php

namespace App\Livewire;

use App\Models\Bookmarks as ModelsBookmarks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bookmarks extends Component
{
    public $isClicked = false;
    public $id_item;

    public function mount($id_item)
    {
        $this->id_item = $id_item;

        $this->isClicked = ModelsBookmarks::where('name_user', Auth::user()->name)
            ->where('item_id', $this->id_item)
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
                ->where('item_id', $this->id_item)
                ->delete();
        } else {
            // if not exist on database, add to the database
            $addBookmarks = new ModelsBookmarks([
                'name_user' => Auth::user()->name,
                'item_id' => $this->id_item,
            ]);

            $addBookmarks->save();
        }

        // changing the button effect
        $this->isClicked = !$this->isClicked;

    }
}
