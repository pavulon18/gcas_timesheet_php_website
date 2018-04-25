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

//print_r($viewmodel);
//die();
?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Day</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>PTO Day</th>
                <th>Reg Time</th>
                <th>Over Time</th>
                <th>PTO Hours</th>
            </tr>
        </thead>
        <?php foreach ($viewmodel as $item) : ?>
            <tbody>
                <tr>
                    <?php 
                    /**
                     * Yes, I changed styles between the first set and second set.
                     * It was an experiement to see which way was easier.
                     * 
                     * The verdict is still out.
                     */
                    if ($item['DateTime_In'] != null) 
                    {
                        ?>
                        <td><?php echo date('D', strtotime($item['DateTime_In'])); ?></td>
                        <td><?php echo date('M-d-Y', strtotime($item['DateTime_In'])); ?></td>
                        <td><?php echo date(($item['DateTime_In'])); ?></td>
                        <td><?php echo date(($item['DateTime_Out'])); ?></td>
                    <?php
                    }
                    else
                    {
                        echo '<td>-</td>';
                        echo '<td>-</td>';
                        echo '<td>-</td>';
                        echo '<td>-</td>';
                    }
                    
                    if ($item['Is_Sick_Day'] == 'Y')
                    {
                        echo '<td>Sick Day</td>';
                    }
                    elseif ($item['Is_Vacation_Day'] == 'Y')
                    {
                        echo '<td>Vacation Day</td>';
                    }
                    elseif ($item['Is_Personal_Day'] == 'Y')
                    {
                        echo '<td>Personal Day</td>';
                    }
                    elseif ($item['Is_Berevement_Day'] == 'Y')
                    {
                        echo '<td>Berevement Day</td>';
                    }
                    elseif ($item['Is_FMLA_Day'] == 'Y')
                    {
                        echo '<td>FMLA Day</td>';
                    }
                    elseif ($item['Is_Short_Term_Disability_Day'] == 'Y')
                    {
                        echo '<td>Short Term Disability Day</td>';
                    }
                    elseif ($item['Is_Long_Term_Disability_Day'] == 'Y')
                    {
                        echo '<td>Long Term Disability Day</td>';
                    }
                    else
                    {
                        echo '<td>-</td>';
                    }
                    ?>
                    <td><?php echo date(($item['RegularTime'])); ?></td>
                    <td><?php echo date(($item['OverTime'])); ?></td>
                    <td><?php echo date(($item['NonWorkTime'])); ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>
