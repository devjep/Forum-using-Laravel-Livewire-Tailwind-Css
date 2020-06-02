<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public $commentContent;
    public $commentImage;
   
    public $postId =1;

    protected $listeners = [
        'commentfileUpload' => 'handleFileUpload',
        'postSelected',
    ];

    public function postSelected($postId)
    {
        $this->postId = $postId;
       
    }
    
    public function handleFileUpload($imageData)
    {
        $this->commentImage = $imageData;
    }

    public function store(){
        $this->validate([
            'commentContent' => 'required'
        ]);
        $commentImage = $this->storeImage();

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->postId,
            'comment' => $this->commentContent,
            'image' => $commentImage,
           
        ]);
        $this->commentContent = "";
        $this->commentImage = "";
        
    }

    public function storeImage()
    {
        if(!$this->commentImage){
            return null;
        } 
        $img = ImageManagerStatic::make($this->commentImage)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name,$img);
        return $name;
    }

    public function render()
    {
       
        $comments = Comment::where('post_id', $this->postId)->latest()->get();
        return view('livewire.comments')->withComments($comments);
    }
}
