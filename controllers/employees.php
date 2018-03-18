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

class Employees extends Controller
{
    protected function Index()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->Index(), true);
    }
    
    protected function login()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->login(), true);
    }
    
    protected function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        unset($_SESSION['empNum']);
        session_destroy();
        
        //Redirect
        header('Location: '.ROOT_URL);
    }
    
    protected function forgotPassword()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->forgotpassword(), true);
    }
    
    protected function resetpassword()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->resetpassword(), true);
    }
    
    protected function changeknownpassword()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->changeknownpassword(), true);
    }
    
    protected function changeforgottenpassword()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->changeforgottenpassword(), true);
    }
    
    protected function currentpay()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->currentpay(), true);
    }
    
    protected function historicalpay()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->historicalpay(), true);
    }
    
    protected function ptodays()
    {
        $viewmodel = new EmployeeModel();
        $this->returnView($viewmodel->ptodays(), true);
    }
}