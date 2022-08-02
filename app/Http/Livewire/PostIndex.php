<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class PostIndex extends Component
{
    use WithFileUploads;
    public $showPostModal = false;
    public $title,$image,$content,$oldImage,$post;
    public $isEditMode = false;

    public function render()
    {
        return view('livewire.post-index' , [
            'posts' => Post::all(),
        ]);
    }

    public function showPostModal(){
        $this->reset();
        $this->showPostModal = true;
    }

    public function savePost(){

        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $postImage = $this->image->store('public/posts');

        Post::create([
            'title' => $this->title,
            'image' => $postImage,
            'content' => $this->content,
        ]);

        $this->reset();
    }

    public function updatePost(){

        $this->validate([
            // 'image' => 'image|max:1024', // 1MB Max
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $image = $this->post->image;

        if($this->image){
            $image = $this->image->store('public/posts');
        }

        $this->post->update([
            'image' => $image,
            'title'=>$this->title,
            'content' => $this->content,
        ]);

        $this->reset();
    }


    public function deletePost($postId){
        $post = Post::findOrFail($postId);
        Storage::delete($post->image);
        $post->delete();
        $this->reset();
    }

    public function ShowEditPostModal($postId){
        $this->post = Post::findOrFail($postId);

        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->oldImage = $this->post->image;
        $this->isEditMode = true;
        $this->showPostModal = true;
    }
}
