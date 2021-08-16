<?php

namespace Core;

abstract class Controller {

    protected function view($view, $params = []) {
        return new View($view, $params);
    }

}
