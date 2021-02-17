<?php

class Form
{
    public function createLabel($forAttr, $content)
    {
        return '<label for="' . $forAttr . '" class="form-label fw-bold m-0">' . $content . '</label>';
    }

    public function createInput($type, $id, $name = null)
    {
        $name = (isset($name)) ? $name : $id;
        return '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" class="form-control mb-3" required>';
    }

    public function createSubmit()
    {
        return '<button class="btn btn-primary mt-3">Valider</button>';
    }
}
