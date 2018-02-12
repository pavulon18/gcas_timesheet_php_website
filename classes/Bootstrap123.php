<?php

/*
 * The MIT License
 *
 * Copyright 2018 Jim Baize <pavulon@hotmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Bootstrap
{

    private $controller;
    private $action;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        if ($this->request['controller'] == "")
        {
            $this->controller = 'home';
        } else
        {
            $this->controller = $this->request['controller'];
        }
        if ($this->request['action'] == "")
        {
            $this->action = 'index';
        } else
        {
            $this->action = $this->request['action'];
        }
    }

    public function createController()
    {
        // Check Class
        if (class_exists($this->controller))
        {
            $parents = class_parents($this->controller);
            //check extended
            if (in_array("Controller", $parents))
            {
                if (method_exists($this->controller, $this->action))
                {
                    return new $this->controller($this->action, $this->request);
                } else
                {
                    // Method does not Exist
                    echo '<h1>Method does not exist</h1>';
                    return;
                }
            } else
            {
                // Controller does not Exist
                echo '<h1>Base Controller not found</h1>';
                return;
            }
        }
        else
        {
            // Controller Class does not Exist
                echo '<h1>Controller Class does not exist</h1>';
                return;
        }
    }

}
