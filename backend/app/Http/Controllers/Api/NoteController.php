<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Http\Requests\NotePostRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Http\Requests\NoteArchiveRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotes()
    {
        try {
            $notes = Note::where('isArchived', '0')
                ->orderBy('isFixed', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->get();
            return $notes;
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al cargar las notas: ' .$th
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createNote(NotePostRequest $request)
    {
        try {
            $validated = $request->validated();
            Note::create($validated);
            $message = 'Nota creada exitosamente';
        } catch (\Exception $th) {
            $message = 'Error al guadar la nota: ' . $th;
        }

        return response()->json(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showArchivedNotes()
    {
        try {
            $notes = Note::where('isArchived', '1')
                ->orderBy('created_at', 'DESC')
                ->get();
            return $notes;
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Error al cargar las notas archivadas: ' .$th
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNote(NoteUpdateRequest $request, $id)
    {
        if (!Note::find($id)) return response()->json([
            'message' => 'No hay coincidencias con la información requerida'
        ]);

        try {
            $validated = $request->validated();
            Note::where('id', $id)->update($validated);
            $message = 'Nota actualizada exitosamente';
        } catch (\Exception $th) {
            $message = 'Error al actualizar la nota: ' .$th;
        }

        return response()->json(['message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyNote($id)
    {
        if (!Note::find($id)) return response()->json([
            'message' => 'No hay coincidencias con la información requerida'
        ]);

        try {
            Note::destroy($id);
            $message = 'Nota eliminada exitosamente';
        } catch (\Exception $th) {
            $message = 'Error al eliminar la nota: ' .$th;
        }

        return response()->json(['message' => $message]);
    }

    /**
     * Archive a newly updated note to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archiveNote(NoteArchiveRequest $request, $id)
    {
        if (!Note::find($id)) return response()->json([
            'message' => 'No hay coincidencias con la información requerida'
        ]);

        try {
            $validated = $request->validated();
            Note::find($id)->update([
                'isFixed' => 0,
                'isArchived' => 1,
            ]);
            $message = 'Nota archivada exitosamente';
        } catch (\Exception $th) {
            $message = 'Error al achivar la nota: ' .$th;
        }

        return response()->json(['message' => $message]);
    }
}
