<?php

namespace App\Interfaces;

interface CrudInterface {

    public function cancel();

    public function store();

    public function edit($id);

    public function delete($id);

    public function restore($id);
}
