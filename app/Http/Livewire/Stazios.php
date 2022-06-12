<?php

namespace App\Http\Livewire;

use App\Interfaces\CrudInterface;
use App\Models\Stazio;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Stazios extends BaseCrudComponent implements CrudInterface {

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $page_title = "Stazios";    // Set page title used on list page

    /** Fields of the table */
    public $form = [
        'stazio_id' => '',
        'name'      => ''
    ];

    /** Roles for each field that needs validation */
    protected $rules = [
        'form.stazio_id' => 'sometimes|integer',
        'form.name'      => 'required|string|max:255'
    ];

    public $sort = false;

    public $search = '';

    public $model = Stazio::class;     // Model used for store data

    /**
     * Render component
     */

    public function render()
    {
        $stazios = $this->model::withTrashed()->orderBy('name',($this->sort ? 'desc' : 'asc'))->search('name',$this->search)->paginate(15);
        return view('livewire.stazios.list', ['stazios' => $stazios])->extends('layouts.app');
    }

    /**
     * Save or update element on db
     */

    public function store() {

        $this->validate();

        //if validation is passed -> store new element or update existing one

        $item = $this->model::updateOrCreate(['id' => $this->form['stazio_id']], [
            'name'  => $this->form['name']
        ]);

        //everything completed

        $message = $this->form['stazio_id'] ? __(\config('app.updated_item_message')) : __(\config('app.created_item_message'));

        \App\Helpers\Messages::sessionMessage('success',$message, $item->name);
        $this->dispatchBrowserEvent('closeModal');  //handle modal dismiss event written on blade file
        $this->resetInputFields();
    }

    /**
     * Show modal to edit a specific element
     * @param Int $id
     */

    public function edit($id) {

        try {
        $agency = $this->model::findOrFail($id);
        $this->form['stazio_id']    = $agency->id;
        $this->form['name']         = $agency->name;
        }
        catch (ModelNotFoundException $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_found_message'));
            Log::error( 'Errore edit ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
    }
}
