<?php

namespace App\Http\Livewire;

use App\Models\Agency;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class Agencies extends BaseCrudComponent implements \App\Interfaces\CrudInterface
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $page_title = "Agencies";    // Set page title used on list page

    /** Fields of the table */
    public $form = [
        'agency_id' => '',
        'name'      => ''
    ];

    /** Roles for each field that needs validation */
    protected $rules = [
        'form.agency_id' => 'sometimes|integer',
        'form.name'      => 'required|string|max:255'
    ];

    public $sort = false;

    public $search = '';

    public $model = Agency::class;      // Model used for store data

    /**
     * Render component
     */

    public function render()
    {
        $agencies = $this->model::withTrashed()->orderBy('name',($this->sort ? 'desc' : 'asc'))->search('name',$this->search)->paginate(15);
        return view('livewire.agencies.list', ['agencies' => $agencies])->extends('layouts.app');
    }

    /**
     * Save or update element on db
     */

    public function store() {

        $this->validate();

        //if validation is passed -> store new element or update existing one

        $item = $this->model::updateOrCreate(['id' => $this->form['agency_id']], [
            'name'  => $this->form['name']
        ]);

        //everything completed

        $message = $this->form['agency_id'] ? __(\config('app.updated_item_message')) : __(\config('app.created_item_message'));

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
        $this->form['agency_id']    = $agency->id;
        $this->form['name']         = $agency->name;
        }
        catch (ModelNotFoundException $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_found_message'));
            Log::error( 'Errore edit ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
    }


}
