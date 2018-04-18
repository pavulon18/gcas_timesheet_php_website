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

/**
 * Description of administrators
 *
 * @author Jim Baize <pavulon@hotmail.com>
 * 
 * This class will contain all of the administrator level functions.
 * 
 */
class Administrators extends Controller
{
    //I'm thinking I need a method called "isAdmin".  The purpose of this method
    //would be to verify if the user has admin level permissions.
    
    protected function Index()
    {
        $viewmodel = new AdministratorModel();
        $this->returnView($viewmodel->Index(), true);
    }
    
    protected function register()
    {
        $viewmodel = new AdministratorModel();
        $this->returnView($viewmodel->register(), true);
    }
    
    protected function roster()
    {
        $viewmodel = new AdministratorModel();
        $this->returnView($viewmodel->roster(), true);
    }
    
    protected function changeuserpass()
    {
        $viewmodel = new AdministratorModel();
        $this->returnView($viewmodel->changeuserpass(), true);
    }
    
    protected function currentpay()
    {
        $viewmodel = new AdministratorModel();
        $this->returnView($viewmodel->currentpay(), true);
    }
}
