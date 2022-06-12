<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class BaseCrudComponent extends Component {

    public $selectedElements = [];  //checkboxes

    public $selectAll = false;      // fill all checkboxes

    public $modalWindow;

    public function mount() {

        $this->modalWindow = class_basename($this->model) . "Modal";
    }


    /**
     * Handle bulk operations (delete and destroy)
     * @param Boolean $hard
     */


    public function bulk($hard = false) {

        $elements = $this->model::whereIn('id',$this->selectedElements);
        $hard ? $elements->forceDelete() : $elements->delete();

        $this->selectedElements = [];
        $this->selectAll = false;

        if ($hard) {
            \App\Helpers\Messages::sessionMessage('success', \config('app.multiple_delete_ok_message'));
        }
        else {
            \App\Helpers\Messages::sessionMessage('success', \config('app.multiple_trash_ok_message'));
        }

    }

    /**
     * Restore all elements on table
     * @return void
     */

    public function restoreAll() {

        $this->model::onlyTrashed()->restore();
        \App\Helpers\Messages::sessionMessage('success', \config('app.multiple_restore_ok_message'));

    }

    /**
     * If press checkbox i select all checkboxes on the table
     * @param $value
     * @return void
     */

    public function updatedSelectAll($value) {

        if($value) {
            $this->selectedElements = $this->model::withTrashed()->pluck('id');
        }
        else {
            $this->selectedElements = [];
        }
    }

    /**
     * Reset input fields
     *
     * @return void
     */

    protected function resetInputFields()
    {
        $this->form = \array_fill_keys(\array_keys($this->form), '');
    }

    /**
     * When i click cancel or close button on modal
     * I reset input fields
     * @return void
     */

    public function cancel() {
        $this->resetInputFields();
        $this->resetErrorBag();
    }

    /**
     * Delete item from database
     * @param Int $id
     * @return void
     */

    public function delete($id) {
        try {
                $item = $this->model::findOrFail($id);
                $name = $item->name;
                $item->delete();

            //everything completed

            $message = __(\config('app.trashed_item_message'));

            \App\Helpers\Messages::sessionMessage('success',$message, $name);
        }
        catch (ModelNotFoundException $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_found_message'));
            Log::error( 'Errore delete ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
        catch (Exception $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_deleted_message'));
            Log::error( 'Errore delete ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
    }

    /**
     * Destroy item from database
     * @param Int $id
     * @return void
     */

    public function destroy($id) {
        try {
                $item = $this->model::findOrFail($id);
                $name = $item->name;
                $item->forceDelete();

            //everything completed

            $message = __(\config('app.deleted_item_message'));
            \App\Helpers\Messages::sessionMessage('success', $message, $name);
            $this->editing = $this->model::make();
        }
        catch (ModelNotFoundException $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_found_message'));
            Log::error( 'Errore destroy ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
        catch (Exception $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_deleted_message'));
            Log::error( 'Errore destroy ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
    }

    /**
     * Restore item from database
     * @param Int $id
     * @return void
     */

    public function restore($id) {
        try {
            $this->model::withTrashed()->where('id',$id)->restore();
            $item = $this->model::findOrFail($id);
            //everything completed

            $message = __(\config('app.restored_item_message'));

            \App\Helpers\Messages::sessionMessage('success', $message, $item->name);
        }
        catch (ModelNotFoundException $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.item_not_found_message'));
            Log::error( 'Errore restore ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
        catch (Exception $e) {
            \App\Helpers\Messages::sessionMessage('danger', \config('app.not_restored_item_message'));
            Log::error( 'Errore restore ' . class_basename($this->model) .' : ' . $e->getMessage());
        }
    }

}
