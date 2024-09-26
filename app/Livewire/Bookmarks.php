<?php

namespace App\Livewire;

use App\Models\Bookmarks as ModelsBookmarks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bookmarks extends Component
{
    public $isClicked = false;
    public $id_item;
    public $item_type;

    public function mount($id_item, $item_type)
    {
        $this->id_item = $id_item;
        $this->item_type = $item_type;

        $this->isClicked = ModelsBookmarks::where('name_user', Auth::user()->name)
            ->where('item_id', $this->id_item)
            ->where('item_type', $this->item_type)
            ->exists();
    }

    public function render()
    {
        return view('livewire.bookmarks');
    }

    public function bookmark(){
        if ($this->isClicked) {
            // if alr exist database, gonna removed it from database
            // ModelsBookmarks::where('name_user', Auth::user()->name)
            ModelsBookmarks::where('id_user', Auth::user()->id)
                ->where('item_id', $this->id_item)
                ->where('item_type', $this->item_type)
                ->delete();
        } else {
            // if not exist on database, add to the database
            $addBookmarks = new ModelsBookmarks([
                'id_user' => Auth::user()->id,
                'name_user' => Auth::user()->name,
                'item_id' => $this->id_item,
                'item_type' => $this->item_type,
            ]);

            $addBookmarks->save();
            toast('Ditambahkan Ke Bookmark','success'); // a virus here 
        }

        // changing the button effect
        $this->isClicked = !$this->isClicked;

    }
}
