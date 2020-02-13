<?php


namespace App\Http\Controllers\Page;


use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function getNotes($idOrder)
    {
        $notes = Notes::where('order_id', $idOrder)->orderBy('created_at', 'desc')->get();

        $returnText = '';
        foreach ($notes as $note)
        {
            $returnText .= '<span class="owner-note">'.$note->owner->name.' '.$note->owner->surname.' - '.$note->created_at.'</span><br />';
            $returnText .= '<span class="text-note">'.$note->text.'<hr />';
        }

        return $returnText;
    }

    public function addNote(Request $request)
    {
        $noteText = $request->noteText;
        Notes::create([
            'order_id' => $request->idOrder,
            'user_id' => Auth::user()->id,
            'text' => $request->noteText,
            'status' => 5
        ]);
    }
}
