<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('auteur')->orderBy('datePublication', 'desc')->get();
        return view('dashboard', compact('posts'));
    }




//    public function create()
//    {
//        return view('posts.create');
//    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'contenu' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'auteur' => $user->id,
            'contenu' => $request->contenu,
            'image' => $imagePath,
            'datePublication'=>Carbon::now()

        ]);

        return redirect()->back()->with('success', 'Post créé avec succès !');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->auteur !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation de modifier ce post.');
        }
        $request->validate([
            'contenu' => 'required|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->contenu = $request->contenu;
        $post->save();
        return redirect()->route('posts.index')->with('success', 'Post mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        if ($post->auteur !== $user->id) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation de supprimer ce post.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post supprimé avec succès.');
    }
}
