<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CommentsComponent extends Component
{
    use Actions;
    use WithPagination;

    public $open = false;
    public Post $post;
    public $comment;
    public $edit_comment;
    public $edit_input;

    public $validationAttributes = [
        'comment' => 'comentario',
        'edit_input' => 'comentario',
    ];  

    public function save()
    {
        $this->validate([
            'comment' => 'required|min:3|max:300',
        ]);
        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $this->comment,
        ]);
        $this->notification()->success(
            $title = "Comentario agregado",
            $description = "El comentario se ha agregado correctamente"
        );
        $this->reset('comment');
        $this->post->fresh();
    }

    public function delete(Comment $comment)
    {
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
            $this->notification()->success(
                $title = 'Comentario eliminado',
                $description = 'El comentario ha sido eliminado correctamente'
            );
        }else{
            $this->notification()->error(
                $title = 'No estas autorizado para eliminar este comentario',
                $description = 'Solo puedes eliminar tus comentarios, si necesitas eliminar un comentario que no te pertenezca, ponte en contacto con el administrador del sitio'
            );
            return;
        }
        $this->post = $this->post->fresh();
    }

    public function edit($id)
    {
        $this->edit_comment = Comment::find($id);
        $this->edit_input = $this->edit_comment->comment;
        $this->open = true;
    }

    public function update()
    {
        $this->validate([
            'edit_input' => 'required|min:3|max:300',
        ]);
        $this->edit_comment->update([
            'comment' => $this->edit_input,
        ]);
        $this->reset('comment', 'edit_comment', 'edit_input', 'open');
        $this->post = $this->post->fresh();
        $this->notification()->success(
            $title = 'Comentario actualizado',
            $description = 'El comentario se ha actualizado correctamente'
        );
    }

    public function render()
    {
        $comments = $this->post->comments()->paginate(6);
        return view('livewire.comments-component', compact('comments'));
    }
}
