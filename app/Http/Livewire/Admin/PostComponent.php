<?php

namespace App\Http\Livewire\Admin;

use App\Models\CategoryPost;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class PostComponent extends Component
{
    public $urls=[];
    public $post;
    public $asyncSearchUser;
    public $categories;

    public $input=[
        'title',
        'slug',
        'body',
        'is_draft' => false,
        'category_id' => '',
        'user_id'
    ];

    protected function rules()
    {
        return [
            'input.title' => 'required|min:3|max:255|unique:posts,title',
            'input.slug' => 'required|min:3|max:255|unique:posts,slug',
            'input.body' => 'required|min:3',
            'input.category_id' => 'required|exists:category_posts,id',
            'input.is_draft' => 'required|boolean',
        ];
    }

    protected $validationAttributes = [
        'input.title' => 'Título',
        'input.slug' => 'Slug',
        'input.body' => 'Cuerpo',
        'input.is_draft' => 'Estado',
        'input.category_id' => 'Categoría',
    ];

    public function mount()
    {
        $this->categories = CategoryPost::query()->select('id', 'name')->get()->toArray();
    }

    public function updatedInputTitle($value){
        $this->input['slug'] = Str::slug($value);
    }

    public function save(){
        $this->validate();
        $this->input['user_id'] = auth()->user()->id;
        $post = Post::create($this->input);
        $this->syncUsedImagesPost($post);
        $this->deleteUnusedImages();
        $this->reset('input');
        session()->flash('flash.banner', '¡Se creo la publicación con éxito!');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('posts.home');
    }

    public function syncUsedImagesPost($post){
        foreach ($this->urls as $url) {
            $path = str_replace ( env('APP_URL').'/storage'.'/' , '' , $url);
            Image::where('image_url', $path)->where('post_id', null)->update(['post_id' => $post->id]);
        }
    }

    public function deleteUnusedImages(){
        $images = Image::where('post_id', null)->get();
        foreach ($images as $image) {
            Storage::delete($image->image_url);
            $image->delete();
        }
    }

    public function render()
    {
        return view('livewire.admin.post-component');
    }
}
