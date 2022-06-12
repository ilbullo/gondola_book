<?php

namespace App\Helpers;

class Messages {

    /**
     * Set session message
     * @param String $type
     * @param String $message
     * @param String $name
     * @return void
     */

    public static function sessionMessage($type,$message,$name = null) : void {

        session()->flash(
            'message',
            __($message)
        );
        //check if passed element name
        if ($name) {
            session()->flash('element', $name);
        }

        session()->flash('type', $type);
    }
}
