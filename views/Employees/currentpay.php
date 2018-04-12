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
 * 
 * https://jqueryvalidation.org/
 */

Miscellaneous::checkIsLoggedIn();
?>
<div>
    <?php foreach ($viewmodel as $item) : ?>
        <div class="row justify-content-md-center">
            <div class="col">
                <?php echo date('D', strtotime($item['DateTime_In'])); ?>
            </div>
            <div class="col">
                <?php echo $item['DateTime_In']; ?>
            </div>
            <div class="col">
                <?php echo $item['DateTime_Out']; ?>
            
                <?php
                if ($item['Is_Sick_Day'] == 'Y')
                {
                    echo 'Sick Day';
                } elseif ($item['Is_Vacation_Day'] == 'Y')
                {
                    echo 'Vacation Day';
                } elseif ($item['Is_Personal_Day'] == 'Y')
                {
                    echo 'Personal Day';
                } elseif ($item['Is_Berevement_Day'] == 'Y')
                {
                    echo 'Berevement Day';
                } elseif ($item['Is_FMLA_Day'] == 'Y')
                {
                    echo 'FMLA Day';
                } elseif ($item['Is_Short_Term_Disability_Day'] == 'Y')
                {
                    echo 'Short Term Disability Day';
                } elseif ($item['Is_Long_Term_Disability_Day'] == 'Y')
                {
                    echo 'Long Term Disability Day';
                }
                ?>
                
                <?php echo 'Regular Time ' . $item['RegularTime'] . ' ';
                      echo 'OverTime ' . $item['OverTime'] . ' ';
                      echo 'PTO Hours ' . $item['NonWorkTime'] . ' ';
                      ?>
            </div>
        </div>
            <?php endforeach; ?>
</div>